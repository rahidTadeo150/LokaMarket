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
        $notifikasiSeller = collect();
        $jumlahNotifikasiBelumDibaca = 0;

        $user = Auth::user();

        if ($user) {

            $notifikasiSeller = $user->notifications()->latest()->take(8)->get();
            $jumlahNotifikasiBelumDibaca = $user->unreadNotifications()->count();

            if ($user->toko) {

                $tokoId = $user->toko->id;

                $jumlahPesananSeller = Pesanan::query()->whereIn('status', [
                    'dibayar',
                    'diproses',
                ])->whereHas('detail.produk', function ($query) use ($tokoId) {
                    $query->where('toko_id', $tokoId);
                })->count();

            }

        }

        $view->with([
            'jumlahPesananSeller' => $jumlahPesananSeller,
            'notifikasiSeller' => $notifikasiSeller,
            'jumlahNotifikasiBelumDibaca' => $jumlahNotifikasiBelumDibaca,
        ]);

    }
}
