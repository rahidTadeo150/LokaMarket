<?php

namespace App\View\composers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CustomerLayoutComposer
{
    public function compose(View $view): void
    {
        $cartCount = 0;

        if (Auth::check()) {
            $keranjang = keranjang::where('user_id', Auth::id())->first();

            if ($keranjang) {
                $cartCount = $keranjang->detail()->sum('quantity');
            }
        }

        $view->with('cartCount', $cartCount);
    }
}