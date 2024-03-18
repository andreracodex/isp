
<?php

use Andreracodex\Tripay\TripayController;
use Andreracodex\Tripay\TripayServiceProvider;
use Illuminate\Support\Facades\Route;

Route::prefix('tripay')->group(function () {
    Route::get('/instruction/{tripay}', [TripayController::class, 'instruction'])->name('tripay.instruction');
    Route::get('/callback', [TripayController::class, 'callback'])->name('tripay.callback');
});
