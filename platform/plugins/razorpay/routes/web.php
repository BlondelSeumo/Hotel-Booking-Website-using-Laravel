<?php

use Botble\Razorpay\Http\Controllers\RazorpayController;
use Illuminate\Support\Facades\Route;

Route::middleware('core')->group(function () {
    Route::post('payment/razorpay/webhook', [RazorpayController::class, 'webhook'])
        ->name('payments.razorpay.webhook');
});
