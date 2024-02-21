<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WhatsappController;
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

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer
    Route::prefix('customer')->group(function(){
        Route::get('', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('{customer}/edit', [CustomerController::class, 'update']);
        Route::delete('', [CustomerController::class, 'delete'])->name('customer.delete');
    });

    // Paket
    Route::prefix('paket')->group(function(){
        Route::get('', [PaketController::class, 'index'])->name('paket.index');
        Route::get('/create', [PaketController::class, 'create'])->name('paket.create');
        Route::post('', [PaketController::class, 'store'])->name('paket.store');
        Route::get('{paket}/edit', [PaketController::class, 'edit'])->name('paket.edit');
        Route::put('{paket}/edit', [PaketController::class, 'update']);
    });

    // Location
    Route::prefix('location')->group(function(){
        Route::get('', [LocationController::class, 'index'])->name('location.index');
        Route::get('/create', [LocationController::class, 'create'])->name('location.create');
        Route::post('', [LocationController::class, 'store'])->name('location.store');
        Route::get('{location}/edit', [LocationController::class, 'edit'])->name('location.edit');
        Route::put('{location}/edit', [LocationController::class, 'update']);
    });

    // WA
    Route::prefix('wa')->group(function(){
        Route::get('', [WhatsappController::class, 'index'])->name('wa.index');
        Route::get('/create', [WhatsappController::class, 'create'])->name('wa.create');
        Route::get('/qr', [WhatsappController::class, 'link'])->name('wa.link');
        Route::post('', [WhatsappController::class, 'store'])->name('wa.store');
        Route::get('{wa}/edit', [WhatsappController::class, 'edit'])->name('wa.edit');
        Route::put('{wa}/edit', [WhatsappController::class, 'update']);
        Route::delete('', [WhatsappController::class, 'delete'])->name('wa.delete');;
    });

    // Inventaris
    Route::prefix('inve')->group(function(){
        Route::get('', [InventarisController::class, 'index'])->name('inve.index');
        Route::get('/create', [InventarisController::class, 'create'])->name('inve.create');
        Route::post('', [InventarisController::class, 'store'])->name('inve.store');
        Route::get('{inve}/edit', [InventarisController::class, 'edit'])->name('inve.edit');
        Route::put('{inve}/edit', [InventarisController::class, 'update']);
    });

    Route::get('/pdf', [PDFController::class, 'PDFInventaris'])->name('pdf.inventaris');
});

