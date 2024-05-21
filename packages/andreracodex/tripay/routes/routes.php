
<?php

use Andreracodex\Tripay\TripayController;
use Illuminate\Support\Facades\Route;

Route::prefix('tripay')->group(function () {
    Route::get('/instruction/{tripay}', [TripayController::class, 'instruction'])->name('tripay.instruction');
    Route::get('/merchant', [TripayController::class, 'merchant'])->name('tripay.merchant');
    Route::get('/failed', [TripayController::class, 'failed'])->name('tripay.failed');
    Route::post('/merchantstore', [TripayController::class, 'merchantstore'])->name('tripay.merchantstore');
    Route::get('/transaction/{tripay}/{invoices}/{amount}', [TripayController::class, 'transaction'])->name('tripay.transaction');
    Route::post('/short',  [TripayController::class, 'short'])->name('tripay.short');
    Route::get('/{code}', [TripayController::class, 'redirect'])->name('tripay.redirect');
});


Route::post('callback', [TripayController::class, 'handle']);
