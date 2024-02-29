<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\InventarisKategoriController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

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
    Route::prefix('settings')->group(function(){
        Route::get('', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('/create', [ProfileController::class, 'create'])->name('settings.profile-show');
        Route::post('', [ProfileController::class, 'store'])->name('settings.profile-store');
        Route::put('/profile', [ProfileController::class, 'update'])->name('settings.profile-update');
        Route::delete('', [ProfileController::class, 'destroy'])->name('settings.profile-destroy');
        Route::post('/logout', [ProfileController::class, 'logout'])->name('settings.profile-logout');
    });
     // Employee
    Route::prefix('employee')->group(function(){
        Route::get('', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::get('/view', [EmployeeController::class, 'view'])->name('employee.view');
        Route::get('{emp}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('{emp}/edit', [EmployeeController::class, 'update'])->name('customer.update');
        Route::delete('', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    });
    // Customer
    Route::prefix('customer')->group(function(){
        Route::get('', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('{customer}/edit', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('', [CustomerController::class, 'delete'])->name('customer.delete');
    });

    // Paket
    Route::prefix('paket')->group(function(){
        Route::get('', [PaketController::class, 'index'])->name('paket.index');
        Route::get('/create', [PaketController::class, 'create'])->name('paket.create');
        Route::post('', [PaketController::class, 'store'])->name('paket.store');
        Route::get('{paket}/edit', [PaketController::class, 'edit'])->name('paket.edit');
        Route::put('{paket}/update', [PaketController::class, 'update'])->name('paket.update');
        Route::delete('{paket}/delete', [PaketController::class, 'delete'])->name('paket.delete');
    });

    // Location
    Route::prefix('location')->group(function() {
        Route::get('', [LocationController::class, 'index'])->name('location.index');
        Route::get('/create', [LocationController::class, 'create'])->name('location.create');
        // Route::get('/view', [LocationController::class, 'view'])->name('location.view');
        Route::post('/store', [LocationController::class, 'store'])->name('location.store');
        Route::get('{location}/edit', [LocationController::class, 'edit'])->name('location.edit');
        Route::put('{location}/update', [LocationController::class, 'update'])->name('location.update');
        Route::get('{location}/delete', [LocationController::class, 'delete'])->name('location.delete');
    });

    // WA
    Route::prefix('wa')->group(function() {
        Route::get('', [WhatsappController::class, 'index'])->name('wa.index');
        Route::get('/create', [WhatsappController::class, 'create'])->name('wa.create');
        Route::get('/qr', [WhatsappController::class, 'link'])->name('wa.link');
        Route::post('', [WhatsappController::class, 'store'])->name('wa.store');
        Route::get('{wa}/edit', [WhatsappController::class, 'edit'])->name('wa.edit');
        Route::put('{wa}/edit', [WhatsappController::class, 'update']);
        Route::delete('', [WhatsappController::class, 'delete'])->name('wa.delete');;
    });

    // Inventaris Kategori
    Route::prefix('invekategori')->group(function() {
        Route::get('', [InventarisKategoriController::class, 'index'])->name('invekategori.index');
        Route::get('/create', [InventarisKategoriController::class, 'create'])->name('invekategori.create');
        Route::post('/store', [InventarisKategoriController::class, 'store'])->name('invekategori.store');
        Route::get('{invekategori}/edit', [InventarisKategoriController::class, 'edit'])->name('invekategori.edit');
        Route::put('{invekategori}/update', [InventarisKategoriController::class, 'update'])->name('invekategori.update');
        Route::delete('{invekategori}/delete', [InventarisKategoriController::class, 'delete'])->name('invekategori.delete');
    });

    // Inventaris
    Route::prefix('inve')->group(function() {
        Route::get('', [InventarisController::class, 'index'])->name('inve.index');
        Route::get('/create', [InventarisController::class, 'create'])->name('inve.create');
        Route::post('/store', [InventarisController::class, 'store'])->name('inve.store');
        Route::get('{inve}/edit', [InventarisController::class, 'edit'])->name('inve.edit');
        Route::put('{inve}/update', [InventarisController::class, 'update'])->name('inve.update');
        Route::delete('{inve}/delete', [InventarisController::class, 'delete'])->name('inve.delete');
    });
     // Order Customer
    Route::prefix('order')->group(function() {
        Route::get('', [OrderController::class, 'index'])->name('order.index');
        Route::get('/create', [OrderController::class, 'create'])->name('order.create');
        Route::post('/store', [OrderController::class, 'store'])->name('order.store');
        Route::get('{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::put('{order}/update', [OrderController::class, 'update'])->name('order.update');
        Route::delete('{order}/delete', [OrderController::class, 'delete'])->name('order.delete');
    });
    // Ticket
    Route::prefix('ticket')->group(function() {
        Route::get('', [TicketController::class, 'index'])->name('ticket.index');
        Route::get('/create', [TicketController::class, 'create'])->name('ticket.create');
        Route::get('/view', [TicketController::class, 'view'])->name('ticket.view');
        Route::post('/store', [TicketController::class, 'store'])->name('ticket.store');
        Route::get('{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
        Route::put('{ticket}/update', [TicketController::class, 'update'])->name('ticket.update');
        Route::delete('{ticket}/delete', [TicketController::class, 'delete'])->name('ticket.delete');
    });

    Route::get('/pdf', [PDFController::class, 'PDFInventaris'])->name('pdf.inventaris');
});

