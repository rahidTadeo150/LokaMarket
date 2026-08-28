<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/login-user', [authController::class, 'showLoginForm'])->name('cust.login');

Route::get('/', [UserController::class, 'landingPage'])->name('cust.landingPage');
Route::get('/cara-kerja', [UserController::class, 'caraKerjaPage'])->name('cust.caraKerja');
Route::get('/tentang-kami', [UserController::class, 'tentangKamiPage'])->name('cust.tentangKami');
Route::get('/pilihan-produk', [ProductController::class, 'pilihanProduk'])->name('cust.pilihanProduk');

// Tampilan Form Pembeli
Route::get('/register', function () {
    return view('auth.register-pembeli');
});

// Tampilan Form Penjual (UMKM)
Route::get('/register-penjual', function () {
    return view('auth.register-penjual');
});



