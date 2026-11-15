<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLayoutComposer
{
    public function compose(View $view)
    {
        $notifikasiAdmin = collect();
        $jumlahNotifikasiBelumDibaca = 0;

        $user = Auth::user();

        if ($user) {

            $notifikasiAdmin = $user->notifications()->latest()->take(8)->get();

            $jumlahNotifikasiBelumDibaca = $user->unreadNotifications()->count();

        }

        $view->with([
            'notifikasiAdmin' => $notifikasiAdmin,
            'jumlahNotifikasiBelumDibaca' => $jumlahNotifikasiBelumDibaca,
        ]);
    }
}
