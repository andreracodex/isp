
<?php

use Andreracodex\Tripay\TripayController;
use Andreracodex\Tripay\TripayServiceProvider;
use Illuminate\Support\Facades\Route;

Route::prefix('tripay')->group(function(){
    Route::get('/instruction', [TripayController::class, 'instruction'])->name('tripay.instruction');

});
