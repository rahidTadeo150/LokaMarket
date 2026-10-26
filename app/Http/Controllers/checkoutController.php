<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            'pengajuan_return' => [
                'label' => 'Pengajuan Return',
                'class' => 'bg-orange-50 text-orange-700 ring-orange-200',
                'icon' => 'fa-rotate-left',
                'description' => 'Pengajuan return berhasil dikirim dan sedang menunggu pemeriksaan oleh admin.',
            ],

            'return_ditolak' => [
                'label' => 'Return Ditolak',
                'class' => 'bg-red-50 text-red-700 ring-red-200',
                'icon' => 'fa-circle-xmark',
                'description' => 'Pengajuan return ditolak oleh admin. Silakan periksa catatan penolakan untuk mengetahui alasannya.',
            ],

            'telah_direturn' => [
                'label' => 'Telah Direturn',
                'class' => 'bg-purple-50 text-purple-700 ring-purple-200',
                'icon' => 'fa-box-open',
                'description' => 'Proses pengembalian barang telah selesai.',
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

    public function checkoutStatusPage(Request $request, string $nomor_pesanan)
    {

        $pesanan = pesanan::with([
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

}