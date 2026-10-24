<?php

namespace App\View\Composers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SellerLayoutComposer
{
    public function compose(View $view): void
    {
        $jumlahPesananSeller = 0;
        $user = Auth::user();

        if ($user && $user->toko) {
            $tokoId = $user->toko->id;

            $jumlahPesananSeller = Pesanan::query()
                ->whereIn('status', [
                    'dibayar',
                    'diproses',
                    'dikirim',
                ])->whereHas('detail.produk', function ($query) use ($tokoId) {
                    $query->where('toko_id', $tokoId);
                })->count();
        }

        $view->with('jumlahPesananSeller', $jumlahPesananSeller);
    }
}
