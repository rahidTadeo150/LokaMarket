<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller {

    public function toggle(string $slug): JsonResponse {

        $produk = Produk::where('slug', $slug)->firstOrFail();

        $wishlist = Wishlist::where('user_id', Auth::id())->where('produk_id', $produk->id)->first();

        if ($wishlist) {
            $wishlist->delete();

            return response()->json([
                'success' => true,
                'wishlisted' => false,
                'message' => 'Produk dihapus dari wishlist.',
            ]);

        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'produk_id' => $produk->id,
        ]);

        return response()->json([
            'success' => true,
            'wishlisted' => true,
            'message' => 'Produk ditambahkan ke wishlist.',
        ]);

    }

    public function deleteSelected(Request $request) {

        $validated = $request->validate([
            'selected_wishlist' => ['required', 'array', 'min:1'],
            'selected_wishlist.*' => ['required', 'integer', 'distinct'],
        ]);

        $deleted = wishlist::where('user_id', Auth::id())->whereIn('id', $validated['selected_wishlist'])->delete();

        if ($deleted === 0) {
            return back()->with('error', 'Tidak ada produk wishlist yang berhasil dihapus.');
        }

        return back()->with(
            'success',
            $deleted . ' produk berhasil dihapus dari wishlist.'
        );
        
    }   
    
}
