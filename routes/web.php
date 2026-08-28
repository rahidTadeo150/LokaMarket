<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login-user', [AuthController::class, 'showLoginForm'])->name('cust.login');

Route::get('/', [UserController::class, 'landingPage'])->name('cust.landingPage');
Route::get('/cara-kerja', [UserController::class, 'caraKerjaPage'])->name('cust.caraKerja');
Route::get('/tentang-kami', [UserController::class, 'tentangKamiPage'])->name('cust.tentangKami');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('cust.register');
Route::get('/register-penjual', [AuthController::class, 'showRegisterPenjualForm'])->name('seller.register');
