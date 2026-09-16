<?php

namespace App\Http\Controllers;

use App\Models\detail_keranjang;
use App\Models\keranjang;
use App\Models\pembayaran;
use App\Models\pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request) {
        $validated = $request->validate([
            'nama_penerima' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],

            'no_telepon' => [
                'required',
                'string',
                'min:10',
                'max:20',
            ],

            'provinsi_id' => [
                'required',
                'exists:provinsi,id',
            ],

            'kota_id' => [
                'required',
                'exists:kota,id',
            ],

            'kecamatan_id' => [
                'required',
                'exists:kecamatan,id',
            ],

            'kode_pos' => [
                'required',
                'digits:5',
            ],

            'alamat_lengkap' => [
                'required',
                'string',
                'min:10',
                'max:500',
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:500',
            ],

            'metode' => [
                'required',
                'string',
                'max:50',
            ],
        ], [
            'nama_penerima.required' => 'Nama penerima wajib diisi.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'provinsi_id.required' => 'Provinsi wajib dipilih.',
            'provinsi_id.exists' => 'Provinsi tidak valid.',
            'kota_id.required' => 'Kota wajib dipilih.',
            'kota_id.exists' => 'Kota tidak valid.',
            'kecamatan_id.required' => 'Kecamatan wajib dipilih.',
            'kecamatan_id.exists' => 'Kecamatan tidak valid.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'kode_pos.digits' => 'Kode pos harus 5 digit.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'metode.required' => 'Metode pembayaran wajib dipilih.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Ambil keranjang customer
        |--------------------------------------------------------------------------
        */

        $keranjang = Keranjang::with([
            'detail.produk',
        ])
            ->where('user_id', Auth::id())
            ->first();

        if (!$keranjang || $keranjang->detail->isEmpty()) {
            return redirect()
                ->route('cust.keranjang')
                ->with('error', 'Keranjang belanja masih kosong.');
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi produk dan stok
        |--------------------------------------------------------------------------
        */

        foreach ($keranjang->detail as $detail) {

            $produk = $detail->produk;

            if (!$produk) {
                return back()
                    ->with('error', 'Produk tidak ditemukan.')
                    ->withInput();
            }

            if (!$produk->is_active) {
                return back()
                    ->with(
                        'error',
                        "Produk {$produk->nama} sudah tidak tersedia."
                    )
                    ->withInput();
            }

            if ($detail->quantity > $produk->stok) {
                return back()
                    ->with(
                        'error',
                        "Stok produk {$produk->nama} tidak mencukupi."
                    )
                    ->withInput();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Hitung total
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;
        $totalItem = 0;

        foreach ($keranjang->detail as $detail) {

            $harga = $detail->produk->harga;
            $quantity = $detail->quantity;

            $subtotal += $harga * $quantity;
            $totalItem += $quantity;
        }

        // Dummy ongkir sementara
        $ongkir = $totalItem > 0 ? 15000 : 0;

        $totalPembayaran = $subtotal + $ongkir;

        /*
        |--------------------------------------------------------------------------
        | Normalisasi nomor telepon
        |--------------------------------------------------------------------------
        */

        $noTelepon = preg_replace(
            '/\D/',
            '',
            $validated['no_telepon']
        );

        // Jika customer memasukkan 08...
        if (Str::startsWith($noTelepon, '0')) {
            $noTelepon = '62' . substr($noTelepon, 1);
        }

        // Jika memasukkan 8...
        if (Str::startsWith($noTelepon, '8')) {
            $noTelepon = '62' . $noTelepon;
        }

        $noTelepon = '+' . $noTelepon;

        /*
        |--------------------------------------------------------------------------
        | Transaction
        |--------------------------------------------------------------------------
        */

        try {

            $pesanan = DB::transaction(function () use (
                $validated,
                $keranjang,
                $subtotal,
                $ongkir,
                $totalPembayaran,
                $noTelepon
            ) {

                /*
                |--------------------------------------------------------------------------
                | Generate nomor pesanan
                |--------------------------------------------------------------------------
                */

                do {
                    $nomorPesanan =
                        'LM-' .
                        now()->format('Ymd') .
                        '-' .
                        strtoupper(Str::random(6));

                } while (
                    Pesanan::where(
                        'nomor_pesanan',
                        $nomorPesanan
                    )->exists()
                );

                /*
                |--------------------------------------------------------------------------
                | Buat pesanan
                |--------------------------------------------------------------------------
                */

                $pesanan = Pesanan::create([
                    'user_id' => Auth::id(),

                    'nomor_pesanan' => $nomorPesanan,

                    'nama_penerima' =>
                        $validated['nama_penerima'],

                    'no_telepon' => $noTelepon,

                    'provinsi_id' =>
                        $validated['provinsi_id'],

                    'kota_id' =>
                        $validated['kota_id'],

                    'kecamatan_id' =>
                        $validated['kecamatan_id'],

                    'kode_pos' =>
                        $validated['kode_pos'],

                    'alamat_lengkap' =>
                        $validated['alamat_lengkap'],

                    'catatan' =>
                        $validated['catatan'] ?? null,

                    'subtotal' => $subtotal,

                    'ongkir' => $ongkir,

                    'total_pembayaran' =>
                        $totalPembayaran,

                    'status' =>
                        'menunggu_pembayaran',
                ]);

                /*
                |--------------------------------------------------------------------------
                | Copy detail keranjang → detail pesanan
                |--------------------------------------------------------------------------
                */

                foreach ($keranjang->detail as $detail) {

                    $produk = $detail->produk;

                    $harga = $produk->harga;
                    $quantity = $detail->quantity;

                    DetailPesanan::create([
                        'pesanan_id' =>
                            $pesanan->id,

                        'produk_id' =>
                            $produk->id,

                        'nama_produk' =>
                            $produk->nama,

                        'harga' =>
                            $harga,

                        'quantity' =>
                            $quantity,

                        'subtotal' =>
                            $harga * $quantity,
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Buat pembayaran
                |--------------------------------------------------------------------------
                */

                Pembayaran::create([
                    'pesanan_id' =>
                        $pesanan->id,

                    'metode' =>
                        $validated['metode'],

                    'status' =>
                        'pending',

                    'jumlah' =>
                        $totalPembayaran,

                    'transaction_id' =>
                        null,

                    'snap_token' =>
                        null,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Kosongkan keranjang
                |--------------------------------------------------------------------------
                */

                $keranjang->detail()->delete();

                return $pesanan;
            });

            /*
            |--------------------------------------------------------------------------
            | Redirect
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'cust.pembayaran',
                    $pesanan->id
                )
                ->with(
                    'success',
                    'Pesanan berhasil dibuat. Silakan lakukan pembayaran.'
                );

        } catch (\Throwable $e) {

            report($e);

            return back()
                ->with(
                    'error',
                    'Terjadi kesalahan saat membuat pesanan.'
                )
                ->withInput();
        }
    }
}