<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'landingPage'])->name('cust.landingPage');
Route::get('/cara-kerja', [UserController::class, 'caraKerja'])->name('cust.caraKerja');
