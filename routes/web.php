<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'landingPage'])->name('cust.landingPage');
Route::get('/cara-kerja', [UserController::class, 'caraKerja'])->name('cust.caraKerja');
// Tampilan Form Pembeli
Route::get('/register', function () {
    return view('auth.register-pembeli');
});

// Tampilan Form Penjual (UMKM)
Route::get('/register-penjual', function () {
    return view('auth.register-penjual');
});