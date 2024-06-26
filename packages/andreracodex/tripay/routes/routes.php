
<?php

use Andreracodex\Tripay\TripayCallbackController;
use Andreracodex\Tripay\TripayController;
use Illuminate\Support\Facades\Route;

Route::prefix('tripay')->group(function () {
    // Instruksi Pembayaran
    Route::get('/instruction/{tripay}/{paycode}', [TripayController::class, 'instruction'])->name('tripay.instruction');
    // Get Merchant Active
    Route::get('/merchant', [TripayController::class, 'showmerchant'])->name('tripay.merchant');
    // Failed to get Invoice Number
    Route::get('/failed/{errors}', [TripayController::class, 'failed'])->name('tripay.failed');

    Route::get('/trans/{trans}', [TripayController::class, 'trans'])->name('tripay.trans');

    Route::get('/success/{great}', [TripayController::class, 'great'])->name('tripay.great');
    // Tripay Transaction Virtual Number
    Route::post('/merchantstore', [TripayController::class, 'merchantstore'])->name('tripay.merchantstore');

    // Route::get('/transaction/{tripay}/{invoices}/{amount}', [TripayController::class, 'transaction'])->name('tripay.transaction');

    Route::post('/callback', [TripayController::class, 'handle']);

    Route::get('/redirect', [TripayController::class, 'redirect'])->name('tripay.redirect');
    // Check Status Transaction
    Route::post('/checkstatus', [TripayController::class, 'checkstatus'])->name('tripay.checkstatus');
});



