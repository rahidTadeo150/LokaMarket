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
        $notifikasiCustomer = collect();
        $jumlahNotifikasiBelumDibaca = 0;

        $user = Auth::user();

        if ($user) {

            $keranjang = Keranjang::where('user_id', $user->id)
                ->first();

            if ($keranjang) {

                $cartCount = $keranjang->detail()
                    ->sum('quantity');

            }

            $notifikasiCustomer = $user->notifications()->latest()->take(8)->get();

            // Menghitung notifikasi yang belum dibaca
            $jumlahNotifikasiBelumDibaca = $user->unreadNotifications()->count();

        }

        $view->with([
            'cartCount' => $cartCount,
            'notifikasiCustomer' => $notifikasiCustomer,
            'jumlahNotifikasiBelumDibaca' => $jumlahNotifikasiBelumDibaca,
        ]);
    }
}
