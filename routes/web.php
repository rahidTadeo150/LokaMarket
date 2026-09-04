<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\sellerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/login-user', [AuthController::class, 'showLoginForm'])->name('cust.login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('cust.register');
Route::get('/my-profile', [UserController::class, 'myProfilePage'])->name('cust.myProfile');


Route::get('/', [UserController::class, 'landingPage'])->name('cust.landingPage');
Route::get('/cara-kerja', [UserController::class, 'caraKerjaPage'])->name('cust.caraKerja');
Route::get('/tentang-kami', [UserController::class, 'tentangKamiPage'])->name('cust.tentangKami');

Route::get('/pilihan-produk', [ProductController::class, 'pilihanProduk'])->name('cust.pilihanProduk');
Route::get('/kategori-produk', [ProductController::class, 'kategoriPage'])->name('cust.kategori');
Route::get('/detail-produk', [ProductController::class, 'detailProdukPage'])->name('cust.detailProduk');
Route::get('/detail-toko', [ProductController::class, 'detailTokoPage'])->name('cust.detailToko');

Route::get('/register-penjual', [AuthController::class, 'showRegisterPenjualForm'])->name('seller.register');

Route::get('/dashboard-seller', [sellerController::class, 'dashboardSeller'])->name('seller.dashboard');

