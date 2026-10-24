<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

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