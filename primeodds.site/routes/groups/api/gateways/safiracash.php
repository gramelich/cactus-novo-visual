<?php

use App\Http\Controllers\Gateway\SafiraCashController;
use Illuminate\Support\Facades\Route;

Route::prefix('safiracash')
    ->group(function () {
        Route::post('qrcode-pix', [SafiraCashController::class, 'getQRCodePix']);
        Route::post('consult-status-transaction', [SafiraCashController::class, 'consultStatusTransactionPix']);
    });