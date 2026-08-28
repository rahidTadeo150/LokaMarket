<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login-user', [authController::class, 'loginPage'])->name('cust.login');

Route::get('/', [UserController::class, 'landingPage'])->name('cust.landingPage');
Route::get('/cara-kerja', [UserController::class, 'caraKerjaPage'])->name('cust.caraKerja');
Route::get('/tentang-kami', [UserController::class, 'tentangKamiPage'])->name('cust.tentangKami');

