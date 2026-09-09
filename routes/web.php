<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\sellerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/register/verify', [AuthController::class, 'verificationNotice'])->name('verification.notice');
Route::get('/register/verify/{token}', [AuthController::class, 'verifyRegistration'])->name('verification.verify');
Route::post('/register/verification-notification', [AuthController::class, 'resendVerification'])->name('verification.send');


Route::get('/login-user', [AuthController::class, 'showLoginForm'])->name('cust.login');
Route::post('/login-user', [AuthController::class, 'loginCustomer'])->name('cust.loginCustomer');
Route::get('/lupa-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/lupa-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/register-customer', [AuthController::class, 'showRegisterForm'])->name('cust.register');
Route::post('/register-customer', [AuthController::class, 'registerCustomer'])->name('cust.registerNewCustomer');
Route::get('/register-penjual', [AuthController::class, 'showRegisterPenjualForm'])->name('seller.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth', 'role:customer'])->group(function () {                                                                                       

    Route::get('/my-profile', [UserController::class, 'myProfilePage'])->name('cust.myProfile');
    Route::view('/keranjang', 'user.keranjang')->name('cust.keranjang');
    Route::get('/checkout', [UserController::class, 'checkoutPage'])->name('cust.checkout');
    Route::view('/pembayaran', 'user.pembayaran')->name('cust.pembayaran');
    Route::get('/invoice', [UserController::class, 'invoicePage'])->name('cust.invoice');
    Route::get('/edit-profil', [UserController::class, 'editProfilePage'])->name('cust.editProfile');
    Route::put('/edit-profil', [UserController::class, 'updateProfile'])->name('cust.updateProfile');
    Route::get('/detail-produk/{produk}', [ProductController::class, 'detailProdukPage'])->name('cust.detailProduk');
    Route::get('/detail-toko', [ProductController::class, 'detailTokoPage'])->name('cust.detailToko');
});

Route::get('/', [UserController::class, 'landingPage'])->name('cust.landingPage');
Route::get('/cara-kerja', [UserController::class, 'caraKerjaPage'])->name('cust.caraKerja');
Route::get('/tentang-kami', [UserController::class, 'tentangKamiPage'])->name('cust.tentangKami');
Route::get('/pilihan-produk/{kategori?}/{sort?}', [ProductController::class, 'pilihanProduk'])->name('cust.pilihanProduk');
Route::get('/kategori-produk', [ProductController::class, 'kategoriPage'])->name('cust.kategori');

Route::get('/dashboard-seller', [sellerController::class, 'dashboardSeller'])->name('seller.dashboard');

