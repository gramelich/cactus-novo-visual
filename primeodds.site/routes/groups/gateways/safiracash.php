<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gateway\SafiraCashController;

Route::prefix('safiracash')
    ->group(function ()
    {
        Route::post('qrcode-pix', [SafiraCashController::class, 'getQRCodePix']);
        Route::any('callback', [SafiraCashController::class, 'callbackMethod']);
        Route::post('consult-status-transaction', [SafiraCashController::class, 'consultStatusTransactionPix']);

        Route::get('withdrawal/{id}', [SafiraCashController::class, 'withdrawalFromModal'])->name('safiracash.withdrawal');
        Route::get('cancelwithdrawal/{id}', [SafiraCashController::class, 'cancelWithdrawalFromModal'])->name('safiracash.cancelwithdrawal');
    });