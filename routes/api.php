<?php

use App\Http\Controllers\paymentController;
use Illuminate\Support\Facades\Route;

Route::post('/midtrans/notification', [paymentController::class,'handleNotification'])->name('midtrans.notification');
