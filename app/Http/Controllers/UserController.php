<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function myProfilePage() {
        $user = Auth::user(); 
        
        return view('user.profil-user', compact('user'));
    }
    
    public function landingPage() {
        $produk = produk::with('kategori')->inRandomOrder()->take(4);

        return view('user.landing-page', [
            'produk' => $produk->get(),
        ]);
    }

    public function caraKerjaPage() {
        return view('user.cara-kerja');
    }

    public function tentangKamiPage() {
        return view('user.tentang-kami');
    }

}
