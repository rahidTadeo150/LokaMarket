<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-page');
    }

    public function login(Request $request)
    {
        
    }

    public function registerCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'no_telp' => 'required|string|max:15|min:10',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:customer,pemilik_toko',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'role' => 'customer',
        ]);

        return redirect()->route('login') ->with(
            'success', 
            'Registrasi berhasil. Silakan login menggunakan akun Anda.'
        );
    }

    public function showRegisterForm()
    {
        return view('auth.register-pembeli');
    }

    public function showRegisterPenjualForm()
    {
        return view('auth.register-penjual');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}