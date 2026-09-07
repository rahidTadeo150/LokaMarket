<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function myProfilePage() {
        $user = Auth::user(); 
        
        return view('user.profil-user', compact('user'));
    }
    
    public function landingPage() {
        return view('user.landing-page');
    }

    public function caraKerjaPage() {
        return view('user.cara-kerja');
    }

    public function tentangKamiPage() {
        return view('user.tentang-kami');
    }

}
