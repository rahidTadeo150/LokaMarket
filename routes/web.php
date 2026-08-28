<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login-user', [authController::class, 'loginPage'])->name('cust.login');

Route::get('/', [UserController::class, 'landingPage'])->name('cust.landingPage');
<<<<<<< HEAD
Route::get('/cara-kerja', [UserController::class, 'caraKerja'])->name('cust.caraKerja');
// Tampilan Form Pembeli
Route::get('/register', function () {
    return view('auth.register-pembeli');
});

// Tampilan Form Penjual (UMKM)
Route::get('/register-penjual', function () {
    return view('auth.register-penjual');
});
=======
Route::get('/cara-kerja', [UserController::class, 'caraKerjaPage'])->name('cust.caraKerja');
Route::get('/tentang-kami', [UserController::class, 'tentangKamiPage'])->name('cust.tentangKami');

>>>>>>> a9fadc9fc8a23b162e0ef6b73aaa790300980237
