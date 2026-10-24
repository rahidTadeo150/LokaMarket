<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/midtrans/notification', [CheckoutController::class,'handleNotification'])->name('midtrans.notification');
