<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-page');
    }
     // Halaman register pembeli
    public function showRegisterForm()
    {
        return view('auth.register-pembeli');
    }

    // Halaman register penjual
    public function showRegisterPenjualForm()
    {
        return view('auth.register-penjual');
    }

}
