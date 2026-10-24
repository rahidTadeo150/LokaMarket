<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\alamat_pengguna;
use App\Models\keranjang;
use App\Models\payments;
use App\Models\pesanan;
use App\Models\detail_pesanan;
use App\Models\pesanan_toko;
use App\Models\produk;
use App\Models\return_produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Services\SaldoPenjualService;

class paymentController extends Controller
{

    public function checkoutPayment(Request $request)
    {

        $validated = $request->validate([
            'catatan' => ['nullable', 'string', 'max:1000'],

            'payment_method' => [
                'required',
                'in:other_qris,ovo_va,bank_transfer',
            ],

            'bank_code' => [
                'required_if:payment_method,bank_transfer',
                'nullable',
                'in:bca_va,bni_va,bri_va,permata_va,seabank_va',
            ],
        ]);

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Silakan login terlebih dahulu.',
            ], 401);
        }

        $alamat = alamat_pengguna::with([
            'provinsi',
            'kota',
            'kecamatan',
        ])->where('user_id', $user->id)->where('is_default', true)->first();

        if (!$alamat) {
            return response()->json([
                'message' => 'Silakan pilih alamat pengiriman terlebih dahulu.',
            ], 422);
        }

        $checkoutLangsung = session('checkout_langsung');

        $isCheckoutLangsung = !empty($checkoutLangsung['produk_id']) && isset($checkoutLangsung['quantity']) && (int) $checkoutLangsung['quantity'] > 0;

        $keranjang = null;
        $detailsCheckout = collect();

        if ($isCheckoutLangsung) {

            $produkCheckoutInstan = produk::with([
                'kategori',
                'toko',
                'thumbnail',
            ])->where('is_active', true)->find($checkoutLangsung['produk_id']);

            if (!$produkCheckoutInstan) {
                return response()->json([
                    'message' => 'Produk checkout instan tidak ditemukan atau sudah tidak aktif.',
                ], 422);
            }

            $quantityLangsung = (int) $checkoutLangsung['quantity'];

            if ($quantityLangsung > $produkCheckoutInstan->stok) {
                return response()->json([
                    'message' => "Stok produk {$produkCheckoutInstan->nama} tidak mencukupi.",
                ], 422);
            }

            $detailsCheckout->push((object) [
                'produk' => $produkCheckoutInstan,
                'quantity' => $quantityLangsung,
            ]);

        } else {

            $keranjang = Keranjang::with([
                'detail.produk.kategori',
                'detail.produk.toko',
                'detail.produk.thumbnail',
            ])->where('user_id', $user->id)->first();

            if (!$keranjang || $keranjang->detail->isEmpty()) {
                return response()->json([
                    'message' => 'Keranjang kamu masih kosong.',
                ], 422);
            }

            $detailsCheckout = $keranjang->detail;

        }

        $paymentMethod = $validated['payment_method'];
        $bankCode = $validated['bank_code'] ?? null;

        if ($paymentMethod === 'other_qris') {

            $enabledPayments = ['other_qris'];

        } elseif ($paymentMethod === 'ovo_va') {

            $enabledPayments = ['ovo'];

        } else {

            $enabledPayments = [$bankCode];

        }

        $subtotal = 0;
        $midtransItems = [];
        $itemsPesanan = [];

        foreach ($detailsCheckout as $detail) {

            $produk = $detail->produk;

            if (!$produk) {

                return response()->json([
                    'message' => 'Ada produk yang sudah tidak tersedia.',
                ], 422);

            }

            if (!$produk->toko_id || !$produk->toko) {

                return response()->json([
                    'message' => "Toko untuk produk {$produk->nama} tidak ditemukan.",
                ], 422);

            }

            $quantity = (int) $detail->quantity;
            $harga = (int) $produk->harga;

            if ($quantity < 1 || $harga < 0) {

                return response()->json([
                    'message' => 'Data produk atau jumlah produk tidak valid.',
                ], 422);

            }

            if ($produk->stok < $quantity) {

                return response()->json([
                    'message' => "Stok produk {$produk->nama} tidak mencukupi.",
                ], 422);

            }

            $itemSubtotal = $harga * $quantity;

            $subtotal += $itemSubtotal;

            $midtransItems[] = [
                'id' => (string) $produk->id,
                'price' => $harga,
                'quantity' => $quantity,
                'name' => Str::limit($produk->nama, 50, ''),
            ];

            $itemsPesanan[] = [
                'toko_id' => $produk->toko_id,
                'produk_id' => $produk->id,
                'nama_produk' => $produk->nama,
                'nama_toko' => $produk->toko->nama_toko ?? '-',
                'foto_produk' => $produk->thumbnail?->foto,
                'quantity' => $quantity,
                'harga' => $harga,
                'subtotal' => $itemSubtotal,
            ];

        }

        if (empty($itemsPesanan)) {

            return response()->json([
                'message' => 'Tidak ada produk yang dapat diproses.',
            ], 422);

        }

        $kelompokToko = collect($itemsPesanan)->groupBy('toko_id');

        $ringkasanOngkirToko = [];
        $ongkir = 0;

        foreach ($kelompokToko as $tokoId => $items) {

            $subtotalToko = $items->sum('subtotal');
            $itemPertama = $items->first();

            $ongkirToko = 15000;

            $ringkasanOngkirToko[$tokoId] = [
                'toko_id' => $tokoId,
                'nama_toko' => $itemPertama['nama_toko'],
                'subtotal' => $subtotalToko,
                'ongkir' => $ongkirToko,
            ];

            $ongkir += $ongkirToko;

        }

        $totalPembayaran = $subtotal + $ongkir;

        if ($totalPembayaran < 1) {

            return response()->json([
                'message' => 'Total pembayaran tidak valid.',
            ], 422);

        }

        foreach ($ringkasanOngkirToko as $ringkasan) {

            if ($ringkasan['ongkir'] <= 0) {

                continue;

            }

            $midtransItems[] = [
                'id' => 'ONGKIR-' . $ringkasan['toko_id'],
                'price' => (int) $ringkasan['ongkir'],
                'quantity' => 1,
                'name' => Str::limit(
                    'Ongkir - ' . $ringkasan['nama_toko'],
                    50,
                    ''
                ),
            ];
        }

        $serverKey = config('services.midtrans.server_key');
        $clientKey = config('services.midtrans.client_key');

        if (empty($serverKey) || empty($clientKey)) {

            Log::error('Konfigurasi Midtrans belum lengkap.');

            return response()->json([
                'message' => 'Konfigurasi pembayaran belum lengkap.',
            ], 500);

        }

        Config::$serverKey = $serverKey;
        Config::$isProduction = (bool) config(
            'services.midtrans.is_production',
            false
        );
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $pesanan = null;

        try {

            $pesanan = DB::transaction(function () use ($user, $alamat, $validated, $subtotal, $ongkir, $totalPembayaran, $itemsPesanan, $paymentMethod, $bankCode, $ringkasanOngkirToko) {

                $pesanan = Pesanan::create([
                    'user_id' => $user->id,
                    'nomor_pesanan' => 'LOKA-' . strtoupper(Str::random(12)),
                    'nama_penerima' => $alamat->nama_penerima,
                    'no_telepon' => $alamat->no_telepon,
                    'alamat_lengkap' => $alamat->alamat_lengkap,
                    'provinsi_id' => $alamat->provinsi_id,
                    'kota_id' => $alamat->kota_id,
                    'kecamatan_id' => $alamat->kecamatan_id,
                    'kode_pos' => $alamat->kode_pos,
                    'catatan' => $validated['catatan'] ?? null,
                    'subtotal' => $subtotal,
                    'ongkir' => $ongkir,
                    'total_pembayaran' => $totalPembayaran,
                    'payment_method' => $paymentMethod,
                    'status' => 'menunggu_pembayaran',
                ]);

                $kelompokToko = collect($itemsPesanan)->groupBy('toko_id');

                foreach ($kelompokToko as $tokoId => $items) {

                    $subtotalToko = $items->sum('subtotal');

                    $ongkirToko = $ringkasanOngkirToko[$tokoId]['ongkir'] ?? 0;

                    $komisiToko = round($subtotalToko * 0.03, 2);

                    $pesananToko = pesanan_toko::create([
                        'pesanan_id' => $pesanan->id,
                        'toko_id' => $tokoId,
                        'subtotal' => $subtotalToko,
                        'ongkir' => $ongkirToko,
                        'komisi' => $komisiToko,
                        'total_penjual' => $subtotalToko - $komisiToko,
                        'status' => 'menunggu_pembayaran',
                    ]);

                    foreach ($items as $item) {
                        detail_pesanan::create([
                            'pesanan_id' => $pesanan->id,
                            'pesanan_toko_id' => $pesananToko->id,
                            'produk_id' => $item['produk_id'],
                            'nama_produk' => $item['nama_produk'],
                            'nama_toko' => $item['nama_toko'],
                            'foto_produk' => $item['foto_produk'],
                            'quantity' => $item['quantity'],
                            'harga' => $item['harga'],
                            'subtotal' => $item['subtotal'],
                        ]);
                    }

                }

                payments::create([
                    'pesanan_id' => $pesanan->id,
                    'metode' => $bankCode ?? $paymentMethod,
                    'status' => 'pending',
                    'transaction_id' => null,
                    'jumlah' => $totalPembayaran,
                ]);

                return $pesanan;

            });

            $namaPenerima = $alamat->nama_penerima ?: $user->username;

            $transaction = [
                'transaction_details' => [
                    'order_id' => $pesanan->nomor_pesanan,
                    'gross_amount' => (int) $totalPembayaran,
                ],

                'callbacks' => [
                    'finish' => route('cust.checkout.status', [
                        'nomor_pesanan' => $pesanan->nomor_pesanan,
                    ]),
                ],

                'item_details' => $midtransItems,

                'customer_details' => [
                    'first_name' => Str::limit($namaPenerima, 50, ''),
                    'email' => $user->email,
                    'phone' => $alamat->no_telepon,

                    'shipping_address' => [
                        'first_name' => Str::limit($namaPenerima, 50, ''),
                        'phone' => $alamat->no_telepon,
                        'address' => $alamat->alamat_lengkap,
                        'city' => $alamat->kota?->nama ?? '-',
                        'postal_code' => $alamat->kode_pos,
                        'country_code' => 'IDN',
                    ],
                ],

                'enabled_payments' => $enabledPayments,

                'expiry' => [
                    'unit' => 'hour',
                    'duration' => 24,
                ],
            ];

            $snapToken = Snap::getSnapToken($transaction);

            $pesanan->snap_token = $snapToken;
            $pesanan->save();

            // 11. Kosongkan sumber checkout setelah token berhasil dibuat.
            if ($isCheckoutLangsung) {

                session()->forget('checkout_langsung');

            } else {

                if ($keranjang) {

                    DB::transaction(function () use ($user, $keranjang) {

                        $keranjangTerkunci = Keranjang::whereKey($keranjang->id)->where('user_id', $user->id)->lockForUpdate()->first();

                        if ($keranjangTerkunci) {
                            $keranjangTerkunci->detail()->delete();
                        }

                    });

                }

            }

            return response()->json([
                'message' => 'Pesanan berhasil dibuat.',
                'snap_token' => $snapToken,
                'order_id' => $pesanan->nomor_pesanan,
                'status_url' => route('cust.checkout.status', [
                    'nomor_pesanan' => $pesanan->nomor_pesanan,
                ]),
            ]);

        } catch (\Throwable $e) {

            Log::error('Checkout Midtrans gagal', [
                'user_id' => $user->id,
                'order_id' => $pesanan?->nomor_pesanan,
                'error' => $e->getMessage(),
            ]);

            if ($pesanan && !$pesanan->snap_token) {

                try {

                    DB::transaction(function () use ($pesanan) {
                        $pesananTerkunci = Pesanan::whereKey($pesanan->id)->lockForUpdate()->first();

                        if ($pesananTerkunci && $pesananTerkunci->status === 'menunggu_pembayaran' && empty($pesananTerkunci->snap_token)) {

                            detail_pesanan::where('pesanan_id', $pesananTerkunci->id)->delete();
                            pesanan_toko::where('pesanan_id', $pesananTerkunci->id)->delete();
                            payments::where('pesanan_id', $pesananTerkunci->id)->delete();

                            $pesananTerkunci->delete();

                        }

                    });

                } catch (\Throwable $cleanupError) {

                    Log::error('Gagal membersihkan pesanan checkout', [
                        'order_id' => $pesanan->nomor_pesanan,
                        'error' => $cleanupError->getMessage(),
                    ]);

                }
            }

            return response()->json([
                'message' => 'Pembayaran belum dapat diproses. Silakan coba kembali.',
            ], 500);

        }

    }
    
    public function handleNotification(Request $request, SaldoPenjualService $saldoService)
    {

        $data = $request->all();

        if (empty($data['order_id']) || empty($data['status_code']) || !isset($data['gross_amount']) || empty($data['signature_key']) || empty($data['transaction_status'])) {
            return response()->json([
                'message' => 'Data notifikasi tidak lengkap.',
            ], 400);
        }

        $serverKey = config('services.midtrans.server_key');

        if (empty($serverKey)) {

            Log::error('Midtrans Server Key belum dikonfigurasi.');

            return response()->json([
                'message' => 'Konfigurasi pembayaran tidak tersedia.',
            ], 500);

        }

        $signatureExpected = hash(
            'sha512',
            $data['order_id'] . $data['status_code'] . $data['gross_amount'] . $serverKey
        );

        if (!hash_equals($signatureExpected, (string) $data['signature_key'])) {

            Log::warning('Signature notifikasi Midtrans tidak valid.', [
                'order_id' => $data['order_id'],
            ]);

            return response()->json([
                'message' => 'Signature tidak valid.',
            ], 403);

        }

        try {

            DB::transaction(function () use ($data, $saldoService) {

                $pesanan = Pesanan::where('nomor_pesanan', $data['order_id'])->lockForUpdate()->first();

                if (!$pesanan) {
                    throw new \RuntimeException(
                        'Pesanan tidak ditemukan: ' . $data['order_id']
                    );
                }

                $nominalMidtrans = (int) round((float) $data['gross_amount'] * 100);

                $nominalPesanan = (int) round((float) $pesanan->total_pembayaran * 100);

                if ($nominalMidtrans !== $nominalPesanan) {
                    throw new \RuntimeException(
                        'Nominal transaksi tidak sesuai dengan pesanan.'
                    );
                }

                $pembayaran = payments::where('pesanan_id', $pesanan->id)->lockForUpdate()->first();

                if (!$pembayaran) {
                    throw new \RuntimeException(
                        'Data pembayaran tidak ditemukan untuk pesanan '
                        . $pesanan->id
                    );
                }

                $statusTransaksi = $data['transaction_status'];
                $fraudStatus = $data['fraud_status'] ?? null;

                $pembayaranBerhasil = $statusTransaksi === 'settlement' || ($statusTransaksi === 'capture' && $fraudStatus === 'accept');


                if ($pembayaranBerhasil) {

                    if (in_array($pesanan->status, ['dibatalkan', 'selesai'], true)) {

                        Log::warning('Pembayaran berhasil untuk pesanan dengan status khusus.', [
                            'order_id' => $data['order_id'],
                            'status_pesanan' => $pesanan->status,
                        ]);

                        return;

                    }

                    $pembayaranBaruBerhasil = $pembayaran->status !== 'success';

                    if ($pembayaranBaruBerhasil) {

                        $pesanan->load('detail');

                        foreach ($pesanan->detail as $detail) {

                            $produk = produk::whereKey($detail->produk_id)->lockForUpdate()->firstOrFail();

                            $jumlah = (int) $detail->quantity;

                            if ($jumlah < 1) {

                                throw new \RuntimeException(
                                    "Jumlah produk tidak valid pada pesanan {$pesanan->nomor_pesanan}."
                                );

                            }

                            if ($produk->stok < $jumlah) {

                                throw new \RuntimeException(
                                    "Stok produk {$produk->nama} tidak mencukupi."
                                );

                            }

                            $produk->decrement('stok', $jumlah);

                        }

                        $pembayaran->status = 'success';

                        if (!empty($data['transaction_id'])) {

                            $pembayaran->transaction_id = $data['transaction_id'];

                        }

                        $pembayaran->save();

                        $pesanan->status = 'dibayar';
                        $pesanan->dibayar_at = now();
                        $pesanan->save();

                        $jumlahPesananToko = $pesanan->pesananToko()->where('status', 'menunggu_pembayaran')
                            ->update([
                                'status' => 'dibayar',
                                'updated_at' => now(),
                            ]);

                        Log::info('Status pesanan toko diperbarui setelah pembayaran.', [
                            'nomor_pesanan' => $pesanan->nomor_pesanan,
                            'pesanan_id' => $pesanan->id,
                            'jumlah_pesanan_toko_diperbarui' => $jumlahPesananToko,
                        ]);

                        $saldoService->catatPembayaran($pesanan);

                    } else {

                        if ($pesanan->status === 'menunggu_pembayaran') {

                            $pesanan->status = 'dibayar';
                            $pesanan->dibayar_at = $pesanan->dibayar_at ?? now();
                            $pesanan->save();

                        }

                        $jumlahPesananToko = $pesanan->pesananToko()->where('status', 'menunggu_pembayaran')
                            ->update([
                                'status' => 'dibayar',
                                'updated_at' => now(),
                            ]);

                        Log::info('Sinkronisasi status pesanan toko.', [
                            'nomor_pesanan' => $pesanan->nomor_pesanan,
                            'jumlah_pesanan_toko_diperbarui' => $jumlahPesananToko,
                        ]);

                        if (!empty($data['transaction_id']) && empty($pembayaran->transaction_id)) {

                            $pembayaran->transaction_id = $data['transaction_id'];
                            $pembayaran->save();

                        }
                    }

                } elseif (in_array($statusTransaksi, ['deny', 'expire', 'cancel'], true)) {

                    if ($pesanan->status === 'menunggu_pembayaran' && $pembayaran->status === 'pending' ) {

                        $pesanan->status = 'dibatalkan';
                        $pesanan->save();

                        $pesanan->pesananToko()->update([
                            'status' => 'dibatalkan',
                            'updated_at' => now(),
                        ]);

                        $pembayaran->status = $statusTransaksi;

                        if (!empty($data['transaction_id'])) {

                            $pembayaran->transaction_id = $data['transaction_id'];
                            
                        }

                        $pembayaran->save();

                        Log::info('Status pesanan dan pesanan toko dibatalkan melalui webhook.', [
                            'nomor_pesanan' => $pesanan->nomor_pesanan,
                            'status_midtrans' => $statusTransaksi,
                        ]);
                    }
                }

            });

            return response()->json([
                'message' => 'Notifikasi berhasil diproses.',
            ], 200);

        } catch (\Throwable $e) {

            Log::error('Gagal memproses notifikasi Midtrans.', [
                'order_id' => $data['order_id'] ?? null,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Notifikasi gagal diproses.',
            ], 500);

        }

    }
}
