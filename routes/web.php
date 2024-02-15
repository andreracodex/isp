<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('frontend');
Route::get('/forgot-password', [HomeController::class, 'forgotpass'])->name('forgotpassword');
Route::post('/send-mail', [HomeController::class, 'sendmail'])->name('sendmail');

// Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
// Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

Route::middleware('auth','has.role','auth.session')->group(function()
{
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

