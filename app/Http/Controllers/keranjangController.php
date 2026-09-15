<?php

namespace App\Http\Controllers;

use App\Models\detail_keranjang;
use App\Models\Keranjang;
use App\Models\DetailKeranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|integer|exists:produk,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail(
            $validated['produk_id']
        );

        if (!$produk->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Produk sedang tidak tersedia.',
            ], 422);
        }

        if ($produk->stok <= 0) {

            return response()->json([
                'success' => false,
                'message' => 'Produk sedang habis.',
            ], 422);
        }

        try {
            $detail = DB::transaction(function () use ($validated, $produk) {
                $keranjang = keranjang::firstOrCreate([
                    'user_id' => Auth::id(),
                ]);

                $detail = detail_keranjang::where('keranjang_id', $keranjang->id)->where('produk_id', $produk->id)->first();

                if ($detail) {
                    $quantityBaru = $detail->quantity + $validated['quantity'];

                    if ($quantityBaru > $produk->stok) {
                        throw new \Exception(
                            'Jumlah produk di keranjang melebihi stok yang tersedia.'
                        );
                    }

                    $detail->update([
                        'quantity' => $quantityBaru,
                    ]);

                }

                else {
                    if ($validated['quantity'] > $produk->stok) {
                        throw new \Exception(
                            'Jumlah pesanan melebihi stok yang tersedia.'
                        );
                    }

                    $detail = detail_keranjang::create([
                        'keranjang_id' => $keranjang->id,
                        'produk_id' => $produk->id,
                        'quantity' => $validated['quantity'],
                    ]);
                }

                return $detail;

            });

            $keranjang = Keranjang::where('user_id', Auth::id())->first();

            $cartCount = $keranjang ? $keranjang->detail()->sum('quantity') : 0;

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang.',
                'cart_count' => $cartCount,
                'quantity' => $detail->quantity,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,

                'message' => $e->getMessage(),

            ], 422);
        }
    }
}