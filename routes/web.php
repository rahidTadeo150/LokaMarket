<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\alamatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\keranjangController;
use App\Http\Controllers\ongkirController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\pengajuanTokoController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\regions;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\returnController;
use App\Http\Controllers\sellerController;
use App\Http\Controllers\tokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/rajaongkir/test-connection', [ongkirController::class, 'testConnection'])->name('ongkir.testConnection');


Route::get('/register/verify', [AuthController::class, 'verificationNotice'])->name('verification.notice');
Route::get('/register/verify/{token}', [AuthController::class, 'verifyRegistration'])->name('verification.verify');
Route::post('/register/verification-notification', [AuthController::class, 'resendVerification'])->name('verification.send');

Route::get('/form-daftar-toko/verifikasi-notif-me/{email}', [tokoController::class, 'VerificationNotice'])->name('cust.formDaftarToko.notice');
Route::get('/form-daftar-toko/verifikasi/{token}', [tokoController::class, 'verifikasiEmail'])->name('cust.formDaftarToko.verify');


Route::get('/login-admin', [AuthController::class, 'showLoginAdmin'])->name('admin.login');
Route::post('/login-admin', [AuthController::class, 'loginAdmin'])->name('admin.loginAdmin');

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

Route::get('/', [UserController::class, 'landingPage'])->name('cust.landingPage');
Route::get('/cara-kerja', [UserController::class, 'caraKerjaPage'])->name('cust.caraKerja');
Route::get('/tentang-kami', [UserController::class, 'tentangKamiPage'])->name('cust.tentangKami');
Route::get('/pilihan-produk/{kategori?}/{sort?}', [ProductController::class, 'pilihanProduk'])->name('cust.pilihanProduk');
Route::get('/kategori-produk', [ProductController::class, 'kategoriPage'])->name('cust.kategori');

Route::get('/profil-admin', [adminController::class, 'profilAdminPage'])->name('admin.myProfil');
Route::post('/logout-admin', [AuthController::class, 'logoutAdmin'])->name('admin.logout');

Route::get('/dashboard-admin', [adminController::class, 'dashboardAdmin'])->name('admin.dashboard');
Route::get('/pengguna', [adminController::class, 'penggunaPage'])->name('admin.pengguna');
Route::get('/withdraw', [adminController::class, 'withdrawPage'])->name('admin.withdraw');

Route::get('/pengajuan-toko', [adminController::class, 'pengajuanTokoPage'])->name('admin.pengajuanToko');
Route::get('/detail-pengajuan/{id}', [adminController::class, 'detailPengajuanPage'])->name('admin.pengajuanToko.detail');

Route::get('/regions/kota/{provinsi_id}', [regions::class, 'getKota'])->name('regions.kota');
Route::get('/regions/kecamatan/{kota_id}', [regions::class, 'getKecamatan'])->name('regions.kecamatan');

Route::middleware(['auth', 'role:customer,pemilik_toko'])->group(function () {

    Route::get('/rajaongkir/kecamatan/{kecamatan}/mapping', [ongkirController::class, 'mappingRajaOngkir'])->name('ongkir.mapping');

    Route::get('/my-profile', [UserController::class, 'myProfilePage'])->name('cust.myProfile');
    Route::get('/edit-profil', [UserController::class, 'editProfilePage'])->name('cust.editProfile');
    Route::put('/edit-profil', [UserController::class, 'updateProfile'])->name('cust.updateProfile');

    Route::get('/wishlist', [UserController::class, 'wishlistProduk'])->name('cust.wishlist');
    Route::post('/wishlist/{slug}/toggle', [WishlistController::class, 'toggle'])->name('cust.wishlist.toggle');
    Route::delete('/wishlist/delete-selected', [WishlistController::class, 'deleteSelected'])->name('cust.wishlist.deleteSelected');

    Route::get('/benefit-upgrade-account', [UserController::class, 'benefitUpgradeAccount'])->name('cust.benefitUpgradeAccount');
    Route::get('/form-daftar-toko', [UserController::class, 'formDaftarToko'])->name('cust.formDaftarToko');
    Route::get('/lokasi/kecamatan/{kecamatan}/pilihan', [TokoController::class, 'pilihanKodePos'])->name('lokasi.pilihanKodePos');
    Route::post('/form-daftar-toko', [tokoController::class, 'registerToko'])->name('cust.formDaftarToko.register');
    Route::post('/form-daftar-toko/resend-verifikasi', [tokoController::class, 'resendVerifikasi'])->name('cust.resendVerifikasi');
    Route::get('/pengajuan-ulang', [tokoController::class, 'pengajuanUlang'])->name('cust.pengajuanUlang');

    Route::get('/status-pengajuan', [UserController::class, 'statusPengajuan'])->name('cust.statusPengajuan');

    Route::get('/keranjang', [UserController::class, 'keranjangPage'])->name('cust.keranjang');
    Route::post('/keranjang/add-to-cart', [keranjangController::class, 'addToCart'])->name('cust.keranjang.add');
    Route::patch('/keranjang/{detailId}/quantity', [KeranjangController::class, 'updateQuantity'])->name('keranjang.updateQuantity');
    Route::delete('/keranjang/clear-all', [keranjangController::class, 'clearCart'])->name('cust.keranjang.clearAll');
    Route::delete('/keranjang/{id}', [keranjangController::class, 'removeItem'])->name('cust.keranjang.delete');

    Route::get('/pesanan-saya', [CheckoutController::class, 'pesananSayaPage'])->name('cust.pesananSaya');
    Route::post('/pesanan/{nomor_pesanan}/return', [returnController::class, 'pengajuanReturn'])->name('cust.pesanan.return');
    Route::post('/pesanan/{nomor_pesanan}/selesai', [pesananController::class, 'pesananSelesai'])->name('cust.pesanan.selesai');

    Route::get('/checkout', [UserController::class, 'checkoutPage'])->name('cust.checkout');
    Route::post('/checkout/beli-sekarang', [CheckoutController::class, 'beliSekarang'])->name('cust.checkout.beliSekarang');
    Route::get('/checkout/instan', [CheckoutController::class, 'checkoutLangsung'])->name('cust.checkout.langsung');

    Route::post('checkout/pembayaran', [paymentController::class, 'checkoutPayment'])->name('cust.checkout.pay');
    Route::get('checkout/status/{nomor_pesanan}', [CheckoutController::class, 'checkoutStatusPage'])->name('cust.checkout.status');
    Route::post('/checkout/{nomor_pesanan}/cancel', [pesananController::class, 'cancelPesanan',])->name('cust.checkout.cancel');

    Route::get('checkout/invoice', [UserController::class, 'invoicePage'])->name('cust.invoice');

    Route::get('/detail-produk/{produk}', [ProductController::class, 'detailProdukPage'])->name('cust.detailProduk');
    Route::get('/detail-toko', [ProductController::class, 'detailTokoPage'])->name('cust.detailToko');

    Route::get('/pilih-alamat', [UserController::class, 'pilihAlamat'])->name('cust.pilihAlamat');
    Route::get('/tambah-alamat', [UserController::class, 'formAlamat'])->name('cust.formTambahAlamat');
    Route::post('/tambah-alamat', [alamatController::class, 'storeAlamat'])->name('cust.storeAlamat');
    Route::get('/edit-alamat/{id}', [UserController::class, 'formEditAlamat'])->name('cust.formEditAlamat');
    Route::put('/edit-alamat/{id}', [alamatController::class, 'updateAlamat'])->name('cust.updateAlamat');
    Route::delete('/edit-alamat/{id}', [alamatController::class, 'hapusAlamat'])->name('cust.deleteAlamat');
    Route::post('/alamat/{alamat}/set-default', [alamatController::class, 'setDefault'])->name('cust.setDefaultAlamat');

});

Route::middleware(['auth', 'role:pemilik_toko'])->group(function () {

    Route::get('/toko/create-pin', [SellerController::class, 'createPin'])->name('seller.createPin');
    Route::post('/toko/create-pin', [SellerController::class, 'storePin'])->name('seller.storePin');
    Route::get('/toko/verify-pin', [SellerController::class, 'verifyPinPage'])->name('seller.verifyPin');
    Route::post('/toko/verify-pin', [SellerController::class, 'verifyPin'])->middleware('throttle:5,1')->name('seller.verifyPin.submit');

    Route::middleware('cekPinToko')->group(function () {
        Route::post('/toko/logout', [SellerController::class, 'lockToko'])->name('seller.logoutToko');

        Route::get('/dashboard-seller', [sellerController::class, 'dashboardSeller'])->name('seller.dashboard');
        Route::get('/saldo-saya', [sellerController::class, 'saldoSayaPage'])->name('seller.balance');
        Route::view('/laporan', 'seller.laporan-seller')->name('seller.laporan');


        Route::get('/pesanan', [sellerController::class, 'daftarPesananPage'])->name('seller.pesanan');
        Route::patch('/pesanan/{nomor_pesanan}/proses', [pesananController::class, 'prosesPesanan'])->name('seller.pesanan.proses');
        Route::patch('/pesanan/{nomor_pesanan}/kirim', [pesananController::class, 'kirimPesanan'])->name('seller.pesanan.kirim');

        Route::get('/toko-saya', [sellerController::class, 'editTokoPage'])->name('seller.editToko');
        Route::get('/form-edit-toko', [sellerController::class, 'formEditToko'])->name('seller.formEditToko');
        Route::put('/form-edit-toko/update', [tokoController::class, 'updateToko'])->name('seller.formEditToko.update');

        Route::get('/produk-seller', [sellerController::class, 'produkSeller'])->name('seller.produk');
        Route::get('/form-tambah-produk', [sellerController::class, 'tambahProdukPage'])->name('seller.FormTambahProduk');
        Route::post('/form-tambah-produk/store', [sellerController::class, 'storeProduk'])->name('seller.storeProduk');

        Route::get('/edit-produk/{slug}', [sellerController::class, 'editProdukPage'])->name('seller.editProduk');
        Route::put('/edit-produk/update/{slug}', [productController::class, 'updateProduk'])->name('seller.editProduk.update');
        Route::delete('/edit-produk/delete/{slug}', [productController::class, 'deleteProduk'])->name('seller.deleteProduk');

    });

});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-admin', [adminController::class, 'dashboardAdmin'])->name('admin.dashboard');
    Route::get('/pengguna', [adminController::class, 'penggunaPage'])->name('admin.pengguna');
    Route::get('/withdraw', [adminController::class, 'withdrawPage'])->name('admin.withdraw');

    Route::get('/pengajuan-return', [returnController::class, 'pengajuanReturnPage'])->name('admin.pengajuanReturn');


    Route::get('/pengajuan-return', [returnController::class, 'pengajuanReturnPage'])->name('admin.pengajuanReturn');
    Route::get('/pengajuan-return/detail/{id}', [returnController::class, 'detailPengajuanReturn'])->name('admin.pengajuanReturn.detail');
    Route::patch('/pengajuan-return/detail/{id}/approve', [returnController::class, 'approveReturn'])->name('admin.pengajuanReturn.approve');
    Route::patch('/pengajuan-return/detail/{id}/reject', [returnController::class, 'rejectReturn'])->name('admin.pengajuanReturn.reject');

    Route::get('/pengajuan-toko', [adminController::class, 'pengajuanTokoPage'])->name('admin.pengajuanToko');
    Route::post('/approve-toko/{id}', [pengajuanTokoController::class, 'approvePengajuan'])->name('admin.approvePengajuan');
    Route::post('/reject-toko/{id}', [pengajuanTokoController::class, 'rejectPengajuan'])->name('admin.rejectPengajuan');
});