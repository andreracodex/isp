
<?php

use Andreracodex\Tripay\TripayController;
use Illuminate\Support\Facades\Route;

Route::prefix('tripay')->group(function () {
    Route::get('/instruction/{tripay}', [TripayController::class, 'instruction'])->name('tripay.instruction');
    Route::get('/merchant', [TripayController::class, 'merchant'])->name('tripay.merchant');
    Route::get('/callback', [TripayController::class, 'callback'])->name('tripay.callback');
    Route::get('/transaction/{invoices}/{amount}', [TripayController::class, 'transaction'])->name('tripay.transaction');
});
