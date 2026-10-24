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
    public function addToCart(Request $request) {
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

    public function clearCart() {
        $keranjang = keranjang::where('user_id', Auth::id())->first();

        if ($keranjang) {
            $keranjang->detail()->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Keranjang Telah dikosongkan.',
        ]);
    }

    public function removeItem($id) {
        $detail = detail_keranjang::whereHas('keranjang', function ($query) {
                $query->where('user_id', Auth::id());
            })->findOrFail($id);

        $detail->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang.',
        ]);
    }

    public function updateQuantity(Request $request, $detailId) {
        $request->validate([
            'action' => 'required|in:increase,decrease',
        ]);

        $detail = detail_keranjang::with('produk')->where('id', $detailId)->whereHas('keranjang', function ($query) {
                $query->where('user_id', auth()->id());
            })->firstOrFail();

        if ($request->action === 'increase') {

            $detail->quantity++;

        } elseif ($request->action === 'decrease') {

            if ($detail->quantity > 1) {
                $detail->quantity--;
            }

        }

        $detail->save();

        $keranjang = Keranjang::with('detail.produk')->where('user_id', auth()->id())->first();

        if (!$keranjang) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang tidak ditemukan.',
            ], 404);
        }

        $subtotal = $keranjang->detail->sum(function ($item) {
            return $item->produk->harga * $item->quantity;
        });

        $totalItem = $keranjang->detail->sum('quantity');

        $ongkir = 0;

        $totalPembayaran = $subtotal + $ongkir;

        return response()->json([
            'success' => true,
            'message' => 'Jumlah produk berhasil diperbarui.',
            'quantity' => $detail->quantity,
            'item_subtotal' => $detail->produk->harga * $detail->quantity,
            'subtotal' => $subtotal,
            'total_item' => $totalItem,
            'total_pembayaran' => $totalPembayaran,
            'cart_count' => $totalItem,
        ]);
    }
}