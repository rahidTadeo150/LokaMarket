<?php

namespace App\Http\Controllers;

use App\Models\alamat_pengguna;
use App\Models\keranjang;
use App\Models\payments;
use App\Models\pesanan;
use App\Models\detail_pesanan;
use App\Models\produk;
use App\Models\return_produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Services\SaldoPenjualService;

class CheckoutController extends Controller
{
    private function konfigurasiStatusPesanan(string $status): array
    {

        $konfigurasi = [

            'menunggu_pembayaran' => [
                'label' => 'Menunggu Pembayaran',
                'class' => 'bg-amber-50 text-amber-700 ring-amber-200',
                'icon' => 'fa-clock',
                'description' => 'Pesanan berhasil dibuat. Silakan selesaikan pembayaran agar pesanan dapat diproses.',
            ],

            'dibayar' => [
                'label' => 'Pembayaran Berhasil',
                'class' => 'bg-green-50 text-green-700 ring-green-200',
                'icon' => 'fa-circle-check',
                'description' => 'Pembayaran berhasil dikonfirmasi. Pesanan akan segera diproses oleh penjual.',
            ],

            'diproses' => [
                'label' => 'Sedang Diproses',
                'class' => 'bg-blue-50 text-blue-700 ring-blue-200',
                'icon' => 'fa-box',
                'description' => 'Penjual sedang menyiapkan pesananmu.',
            ],

            'dikirim' => [
                'label' => 'Sedang Dikirim',
                'class' => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
                'icon' => 'fa-truck',
                'description' => 'Pesanan sedang dalam perjalanan menuju alamat tujuanmu.',
            ],

            'selesai' => [
                'label' => 'Selesai',
                'class' => 'bg-green-50 text-green-700 ring-green-200',
                'icon' => 'fa-check-double',
                'description' => 'Pesanan telah selesai. Terima kasih telah berbelanja di LokaMarket!',
            ],

            'dibatalkan' => [
                'label' => 'Dibatalkan',
                'class' => 'bg-red-50 text-red-700 ring-red-200',
                'icon' => 'fa-circle-xmark',
                'description' => 'Pesanan ini telah dibatalkan.',
            ],

        ];

        return $konfigurasi[$status] ?? [
            'label' => ucfirst(str_replace('_', ' ', $status)),
            'class' => 'bg-gray-50 text-gray-700 ring-gray-200',
            'icon' => 'fa-circle-info',
            'description' => 'Informasi status pesanan belum tersedia.',
        ];

    }

    public function pesananSayaPage(Request $request)
    {

        $query = Pesanan::where('user_id', $request->user()->id)->with('detail')->latest();

        if ($request->filled('q')) {

            $kataKunci = $request->q;

            $query->where(function ($subQuery) use ($kataKunci) {

                $subQuery->where('nomor_pesanan', 'like', "%{$kataKunci}%")->orWhereHas('detail.produk', function ($detailQuery) use ($kataKunci) {
                    $detailQuery->where('nama', 'like', "%{$kataKunci}%");
                });

            });

        }

        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        $pesanan = $query->paginate(5)->withQueryString();

        $pesananPengguna = Pesanan::where('user_id', $request->user()->id);

        $jumlahPesanan = (clone $pesananPengguna)->count();
        $jumlahMenunggu = (clone $pesananPengguna)->where('status', 'menunggu_pembayaran')->count();
        $jumlahDiproses = (clone $pesananPengguna)->whereIn('status', ['dibayar', 'diproses', 'dikirim'])->count();
        $jumlahSelesai = (clone $pesananPengguna)->where('status', 'selesai')->count();

        $pesanan->getCollection()->transform(function ($item) {

            $detail = $item->detail ?? collect();

            $item->detail_produk = $detail->first();
            $item->jumlah_jenis_produk = $detail->count();
            $item->jumlah_item = $detail->sum('quantity');
            $item->status_info = $this->konfigurasiStatusPesanan($item->status);

            return $item;

        });

        return view('user.pesanan-saya', compact(
            'pesanan',
            'jumlahPesanan',
            'jumlahMenunggu',
            'jumlahDiproses',
            'jumlahSelesai'
        ));

    }

    public function beliSekarang(Request $request)
    {

        $validated = $request->validate([
            'produk_id' => 'required|integer|exists:produk,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $produk = produk::where('is_active', true)->findOrFail($validated['produk_id']);

        $quantity = (int) $validated['quantity'];

        if ($quantity > $produk->stok) {

            return response()->json([
                'success' => false,
                'message' => 'Stok produk tidak mencukupi.',
            ], 422);

        }

        session([
            'checkout_langsung' => [
                'produk_id' => $produk->id,
                'quantity' => $quantity,
            ],
        ]);

        return response()->json([
            'success' => true,
            'redirect_url' => route('cust.checkout.langsung'),
        ]);

    }

    public function checkoutLangsung()
    {

        $data = session('checkout_langsung');

        if (!$data || empty($data['produk_id']) || !isset($data['quantity']) || (int) $data['quantity'] < 1) {

            return redirect()->route('cust.pilihanProduk')
                ->with('error', 'Silakan pilih produk terlebih dahulu.');

        }

        $produk = produk::with([
            'toko',
            'kategori',
            'thumbnail',
        ])->where('is_active', true)->find($data['produk_id']);

        if (!$produk) {

            session()->forget('checkout_langsung');

            return redirect()->route('cust.pilihanProduk')
                ->with('error', 'Produk tidak ditemukan atau sudah tidak aktif.');

        }

        $quantity = (int) $data['quantity'];

        if ($quantity > $produk->stok) {

            return redirect()->route('cust.detailProduk', $produk->slug)
                ->with('error', 'Jumlah produk melebihi stok yang tersedia.');

        }

        $user = Auth::user();

        $alamat = $user->alamat()->where('is_default', true)->first();

        $detail = (object) ['produk' => $produk, 'quantity' => $quantity];
        $keranjang = (object) ['detail' => collect([$detail])];

        $subtotal = $produk->harga * $quantity;
        $totalItem = $quantity;

        $ongkir = $subtotal >= 200000 ? 0 : 15000;

        $totalPembayaran = $subtotal + $ongkir;

        return view('user.checkout', compact(
            'keranjang',
            'alamat',
            'subtotal',
            'totalItem',
            'ongkir',
            'totalPembayaran'
        ));

    }

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
                'produk_id' => $produk->id,
                'nama_produk' => $produk->nama,
                'nama_toko' => $produk->toko?->nama_toko ?? '-',
                'foto_produk' => $produk->thumbnail?->foto,
                'quantity' => $quantity,
                'harga' => $harga,
                'subtotal' => $itemSubtotal,
            ];

        }

        $ongkir = 15000;
        $totalPembayaran = $subtotal + $ongkir;

        if ($ongkir > 0) {
            $midtransItems[] = [
                'id' => 'ONGKIR',
                'price' => $ongkir,
                'quantity' => 1,
                'name' => 'Ongkos Kirim',
            ];
        }

        if ($totalPembayaran < 1) {

            return response()->json([
                'message' => 'Total pembayaran tidak valid.',
            ], 422);

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
        Config::$isProduction = (bool) config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $pesanan = null;

        try {

            $pesanan = DB::transaction(function () use ($user, $alamat, $validated, $subtotal, $ongkir, $totalPembayaran, $itemsPesanan, $paymentMethod, $bankCode) {

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

                    'status' => 'menunggu_pembayaran',
                ]);

                foreach ($itemsPesanan as $item) {
                    detail_pesanan::create([
                        'pesanan_id' => $pesanan->id,
                        ...$item,
                    ]);
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
                    'gross_amount' => $totalPembayaran,
                ],

                'callbacks' => [
                    'finish' => route('cust.checkout.status', [
                        'nomor_pesanan' => $pesanan->nomor_pesanan,
                    ]),
                ],

                'item_details' => $midtransItems,

                'customer_details' => [

                    'first_name' => Str::limit(
                        $namaPenerima,
                        50,
                        ''
                    ),
                    'email' => $user->email,
                    'phone' => $alamat->no_telepon,

                    'shipping_address' => [
                        'first_name' => Str::limit(
                            $namaPenerima,
                            50,
                            ''
                        ),
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
                'status_url' => route('cust.checkout.status', ['nomor_pesanan' => $pesanan->nomor_pesanan]),
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

    public function cancelOrder(Request $request, string $nomor_pesanan)
    {

        $pesanan = Pesanan::where('nomor_pesanan', $nomor_pesanan)->where('user_id', $request->user()->id)->firstOrFail();

        if ($pesanan->status !== 'menunggu_pembayaran') {

            return redirect()->route('cust.checkout.status', ['nomor_pesanan' => $pesanan->nomor_pesanan])
                ->with(
                    'error',
                    'Pesanan tidak dapat dibatalkan karena statusnya sudah berubah.'
                );

        }

        if (!empty($pesanan->snap_token)) {

            try {

                Config::$serverKey = config('services.midtrans.server_key');
                Config::$isProduction = (bool) config('services.midtrans.is_production');
                Config::$isSanitized = true;
                Config::$is3ds = true;

                $transaksi = Transaction::status(
                    $pesanan->nomor_pesanan
                );

                $statusTransaksi = $transaksi->transaction_status ?? null;

                if (in_array($statusTransaksi, ['settlement', 'capture'], true)) {

                    return redirect()->route('cust.checkout.status', ['order' => $pesanan->nomor_pesanan,])
                        ->with(
                            'error',
                            'Pembayaran sudah berhasil. Pesanan tidak dapat dibatalkan melalui tombol ini.'
                        );
                }

                if (in_array($statusTransaksi, ['pending', 'authorize'], true)) {

                    Transaction::cancel($pesanan->nomor_pesanan);

                } elseif (!in_array($statusTransaksi, ['expire', 'cancel', 'deny'], true)) {

                    return redirect()->route('cust.checkout.status', ['nomor_pesanan' => $pesanan->nomor_pesanan,])
                        ->with(
                            'error',
                            'Status transaksi Midtrans belum dapat dipastikan. Silakan periksa transaksi terlebih dahulu.'
                        );

                }

            } catch (\Throwable $e) {

                Log::error('Pembatalan pesanan Midtrans gagal.', [
                    'nomor_pesanan' => $pesanan->nomor_pesanan,
                    'status_pesanan' => $pesanan->status,
                    'is_production' => config('services.midtrans.is_production'),
                    'error' => $e->getMessage(),
                ]);

                return redirect()->route('cust.checkout.status', ['nomor_pesanan' => $pesanan->nomor_pesanan,])
                    ->with(
                        'error',
                        'Status transaksi belum dapat diverifikasi di Midtrans. Pesanan belum dibatalkan. Silakan coba kembali.'
                    );

            }

        }

        $pesanan->status = 'dibatalkan';
        $pesanan->save();

        $pembayaran = payments::where('pesanan_id', $pesanan->id)->first();

        if ($pembayaran && $pembayaran->status === 'pending') {

            $pembayaran->status = 'cancel';
            $pembayaran->save();

        }

        return redirect()->route('cust.checkout.status', ['order' => $pesanan->nomor_pesanan])
            ->with('success', 'Pesanan berhasil dibatalkan.');

    }

    public function checkoutStatusPage(Request $request, string $nomor_pesanan)
    {

        $pesanan = Pesanan::with([
            'detail',
            'provinsi',
            'kota',
            'kecamatan',
        ])->where('nomor_pesanan', $nomor_pesanan)->where('user_id', $request->user()->id)->firstOrFail();

        $statusInfo = $this->konfigurasiStatusPesanan($pesanan->status);

        return view('user.checkout-status', compact(
            'pesanan',
            'statusInfo'
        ));

    }

    public function pengajuanReturn(Request $request, string $nomor_pesanan, SaldoPenjualService $saldoService)
    {

        $validated = $request->validate([
            'alasan_return' => 'required|string|in:produk_tidak_sesuai,produk_rusak,produk_tidak_diterima,produk_salah,lainnya',
            'keterangan_return' => 'nullable|string|max:1000',
        ], [
            'alasan_return.required' => 'Silakan pilih alasan return.',
            'alasan_return.in' => 'Alasan return tidak valid.',
            'keterangan_return.max' => 'Keterangan maksimal 1000 karakter.',
        ]);

        $userId = $request->user()->id;

        DB::transaction(function () use ($nomor_pesanan, $userId, $validated, $saldoService) {

            $pesanan = Pesanan::where('nomor_pesanan', $nomor_pesanan)->where('user_id', $userId)->lockForUpdate()->firstOrFail();

            if ($pesanan->status !== 'dikirim') {
                throw ValidationException::withMessages([
                    'return' => 'return hanya dapat diajukan ketika pesanan berstatus diantar.',
                ]);
            }

            $sudahMengajukan = return_produk::where('pesanan_id', $pesanan->id)
                ->whereIn('status', [
                    'diajukan',
                    'diproses',
                    'disetujui',
                ])->exists();

            if ($sudahMengajukan) {
                throw ValidationException::withMessages([
                    'return' => 'Pesanan ini sudah memiliki pengajuan return.',
                ]);
            }

            return_produk::create([
                'pesanan_id' => $pesanan->id,
                'user_id' => $userId,
                'alasan' => $validated['alasan_return'],
                'keterangan' => $validated['keterangan_return'] ?? null,
                'status' => 'diajukan',
            ]);

            $saldoService->tahanSaldoPesanan($pesanan);

            $pesanan->status = 'pengajuan_return';
            $pesanan->save();
        });

        return redirect()->back()->with(
            'success',
            'Pengajuan return berhasil dikirim. Saldo penjual ditahan selama pemeriksaan.'
        );

    }

    public function pesananSelesai(string $nomor_pesanan, SaldoPenjualService $saldoService)
    {

        try {

            DB::transaction(function () use ($nomor_pesanan, $saldoService) {

                $pesanan = Pesanan::where('nomor_pesanan', $nomor_pesanan)->where('user_id', Auth::id())->lockForUpdate()->firstOrFail();

                if (!in_array($pesanan->status, ['diantar', 'dikirim'], true)) {
                    throw new \RuntimeException(
                        'Status pesanan tidak valid untuk diselesaikan.'
                    );
                }

                $pesanan->status = 'selesai';
                $pesanan->save();

                $saldoService->lepaskanSaldoPesanan($pesanan);
            }, 3);

            return back()->with(
                'success',
                'Pesanan selesai, jangan lupa belanja di lokamart lagi, Happy Shipping!.'
            );

        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
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

                            $jumlah = (int) $detail->jumlah;

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
                        $pesanan->save();

                        $saldoService->catatPembayaran($pesanan);

                    } else {

                        if ($pesanan->status === 'menunggu_pembayaran') {
                            $pesanan->status = 'dibayar';
                            $pesanan->save();
                        }

                        if (!empty($data['transaction_id']) && empty($pembayaran->transaction_id)) {
                            $pembayaran->transaction_id = $data['transaction_id'];
                            $pembayaran->save();
                        }
                    }

                } elseif (in_array($statusTransaksi, ['deny', 'expire', 'cancel'], true)) {

                    if ($pesanan->status === 'menunggu_pembayaran' && $pembayaran->status === 'pending') {

                        $pesanan->status = 'dibatalkan';
                        $pesanan->save();

                        $pembayaran->status = $statusTransaksi;
                        $pembayaran->save();

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