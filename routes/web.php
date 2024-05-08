<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndoRegionController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\InventarisKategoriController;
use App\Http\Controllers\InventarisSatuanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketKategoriController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

require __DIR__. '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('frontend');
Route::get('/forgot-password', [HomeController::class, 'forgotpass'])->name('forgotpassword');
Route::post('/send-mail', [HomeController::class, 'sendmail'])->name('sendmail');

// Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
// Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

Route::middleware('auth', 'has.role', 'auth.session')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PROFILE
    Route::prefix('settings')->group(function () {
        Route::get('', [SettingsController::class, 'index'])->name('settings.index');
        // Roles
        Route::post('rolestore', [SettingsController::class, 'rolestore'])->name('settings.rolestore');
        Route::get('{setting}/editrole', [SettingsController::class, 'roleedit'])->name('settings.roleedit');
        Route::put('{setting}/updaterole', [SettingsController::class, 'roleupdate'])->name('settings.roleupdate');

        Route::get('/create', [ProfileController::class, 'create'])->name('settings.profile-show');
        Route::post('', [ProfileController::class, 'store'])->name('settings.profile-store');
        Route::post('/logout', [ProfileController::class, 'logout'])->name('settings.profile-logout');
        Route::put('/profile', [ProfileController::class, 'update'])->name('settings.profile-update');
        Route::put('{setting}/update', [EmployeeController::class, 'update'])->name('employee.update');
    });

    // Employee
    Route::prefix('employee')->group(function () {
        Route::get('', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('{emp}/view', [EmployeeController::class, 'view'])->name('employee.view');
        Route::get('{emp}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('{emp}/update', [EmployeeController::class, 'update'])->name('employee.update');
        Route::get('{emp}/delete', [EmployeeController::class, 'delete'])->name('employee.delete');
    });

    // Bank
    Route::prefix('bank')->group(function () {
        Route::get('', [BankController::class, 'index'])->name('bank.index');
        Route::get('/create', [BankController::class, 'create'])->name('bank.create');
        Route::post('/store', [BankController::class, 'store'])->name('bank.store');
        Route::get('{bank}/edit', [BankController::class, 'edit'])->name('bank.edit');
        Route::put('{bank}/update', [BankController::class, 'update'])->name('bank.update');
        Route::get('{bank}/delete', [BankController::class, 'delete'])->name('bank.delete');
    });

    // Customer
    Route::prefix('customer')->group(function () {
        Route::get('', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('', [CustomerController::class, 'store'])->name('customer.store');
        Route::post('import', [CustomerController::class, 'import'])->name('customer.import');
        Route::get('{customer}/view', [CustomerController::class, 'view'])->name('customer.view');
        Route::get('{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('{customer}/update', [CustomerController::class, 'update'])->name('customer.update');
        Route::get('{customer}/delete', [CustomerController::class, 'delete'])->name('customer.delete');
    });

    // Paket
    Route::prefix('paket')->group(function () {
        Route::get('', [PaketController::class, 'index'])->name('paket.index');
        Route::get('/create', [PaketController::class, 'create'])->name('paket.create');
        Route::post('', [PaketController::class, 'store'])->name('paket.store');
        Route::get('{paket}/edit', [PaketController::class, 'edit'])->name('paket.edit');
        Route::put('{paket}/update', [PaketController::class, 'update'])->name('paket.update');
        Route::get('{paket}/delete', [PaketController::class, 'delete'])->name('paket.delete');
    });

    // Location
    Route::prefix('location')->group(function () {
        Route::get('', [LocationController::class, 'index'])->name('location.index');
        Route::get('/create', [LocationController::class, 'create'])->name('location.create');
        Route::post('/store', [LocationController::class, 'store'])->name('location.store');
        Route::get('{location}/view', [LocationController::class, 'view'])->name('location.view');
        Route::get('{location}/edit', [LocationController::class, 'edit'])->name('location.edit');
        Route::put('{location}/update', [LocationController::class, 'update'])->name('location.update');
        Route::get('{location}/delete', [LocationController::class, 'delete'])->name('location.delete');
    });

    // WA
    Route::prefix('wa')->group(function () {
        Route::get('', [WhatsappController::class, 'index'])->name('wa.index');
        Route::get('/create', [WhatsappController::class, 'create'])->name('wa.create');
        Route::get('/qr', [WhatsappController::class, 'link'])->name('wa.link');
        Route::post('', [WhatsappController::class, 'store'])->name('wa.store');
        Route::get('{wa}/edit', [WhatsappController::class, 'edit'])->name('wa.edit');
        Route::put('{wa}/edit', [WhatsappController::class, 'update']);
        Route::delete('', [WhatsappController::class, 'delete'])->name('wa.delete');;
    });

    // Inventaris Kategori
    Route::prefix('invekategori')->group(function () {
        Route::get('', [InventarisKategoriController::class, 'index'])->name('invekategori.index');
        Route::get('/create', [InventarisKategoriController::class, 'create'])->name('invekategori.create');
        Route::post('/store', [InventarisKategoriController::class, 'store'])->name('invekategori.store');
        Route::get('{invekategori}/edit', [InventarisKategoriController::class, 'edit'])->name('invekategori.edit');
        Route::put('{invekategori}/update', [InventarisKategoriController::class, 'update'])->name('invekategori.update');
        Route::get('{invekategori}/delete', [InventarisKategoriController::class, 'delete'])->name('invekategori.delete');
    });

    // Inventaris Satuan
    Route::prefix('invesatuan')->group(function () {
        Route::get('', [InventarisSatuanController::class, 'index'])->name('invesatuan.index');
        Route::get('/create', [InventarisSatuanController::class, 'create'])->name('invesatuan.create');
        Route::post('/store', [InventarisSatuanController::class, 'store'])->name('invesatuan.store');
        Route::get('{invesatuan}/edit', [InventarisSatuanController::class, 'edit'])->name('invesatuan.edit');
        Route::put('{invesatuan}/update', [InventarisSatuanController::class, 'update'])->name('invesatuan.update');
        Route::get('{invesatuan}/delete', [InventarisSatuanController::class, 'delete'])->name('invesatuan.delete');
    });

    // Inventaris
    Route::prefix('inve')->group(function () {
        Route::get('', [InventarisController::class, 'index'])->name('inve.index');
        Route::get('/create', [InventarisController::class, 'create'])->name('inve.create');
        Route::post('/store', [InventarisController::class, 'store'])->name('inve.store');
        Route::get('{inve}/view', [InventarisController::class, 'view'])->name('inve.view');
        Route::get('{inve}/edit', [InventarisController::class, 'edit'])->name('inve.edit');
        Route::put('{inve}/update', [InventarisController::class, 'update'])->name('inve.update');
        Route::get('{inve}/delete', [InventarisController::class, 'delete'])->name('inve.delete');
    });

    // Order Customer
    Route::prefix('order')->group(function () {
        Route::get('', [OrderController::class, 'index'])->name('order.index');
        Route::get('/create', [OrderController::class, 'create'])->name('order.create');
        Route::get('/execute', [OrderController::class, 'execute'])->name('order.execute');
        Route::get('{order}/view', [OrderController::class, 'view'])->name('order.view');
        Route::get('{order}/sendwa', [OrderController::class, 'sendwa'])->name('order.sendwa');
        Route::post('/store', [OrderController::class, 'store'])->name('order.store');
        Route::get('{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::put('{order}/update', [OrderController::class, 'update'])->name('order.update');
        Route::get('{order}/delete', [OrderController::class, 'delete'])->name('order.delete');
    });

    Route::prefix('orderdetail')->group(function () {
        Route::get('', [OrderDetailController::class, 'index'])->name('orderdetail.index');
        Route::get('/create', [OrderDetailController::class, 'create'])->name('orderdetail.create');
        Route::get('{orderdetail}/view', [OrderDetailController::class, 'view'])->name('orderdetail.view');
        Route::post('/store', [OrderDetailController::class, 'store'])->name('orderdetail.store');
        Route::get('{orderdetail}/edit', [OrderDetailController::class, 'edit'])->name('orderdetail.edit');
        Route::put('{orderdetail}/update', [OrderDetailController::class, 'update'])->name('orderdetail.update');
        Route::get('{orderdetail}/changestatus', [OrderDetailController::class, 'updatestatus'])->name('orderdetail.changestatus');
        Route::get('{uuid}/print', [OrderDetailController::class, 'print'])->name('orderdetail.print');
        Route::get('{orderdetail}/delete', [OrderDetailController::class, 'delete'])->name('orderdetail.delete');
    });

    // Payment Type
    Route::prefix('paymenttype')->group(function () {
        Route::get('', [PaymentTypeController::class, 'index'])->name('paymenttype.index');
        Route::get('/create', [PaymentTypeController::class, 'create'])->name('paymenttype.create');
        Route::post('/store', [PaymentTypeController::class, 'store'])->name('paymenttype.store');
        Route::get('{paymenttype}/edit', [PaymentTypeController::class, 'edit'])->name('paymenttype.edit');
        Route::put('{paymenttype}/update', [PaymentTypeController::class, 'update'])->name('paymenttype.update');
        Route::get('{paymenttype}/delete', [PaymentTypeController::class, 'delete'])->name('paymenttype.delete');
    });

    // Periode
    Route::prefix('periode')->group(function () {
        Route::get('', [PeriodeController::class, 'index'])->name('periode.index');
        Route::get('/create', [PeriodeController::class, 'create'])->name('periode.create');
        Route::post('/store', [PeriodeController::class, 'store'])->name('periode.store');
        Route::get('{periode}/edit', [PeriodeController::class, 'edit'])->name('periode.edit');
        Route::put('{periode}/update', [PeriodeController::class, 'update'])->name('periode.update');
        Route::get('{periode}/delete', [PeriodeController::class, 'delete'])->name('periode.delete');
    });

    // Ticket
    Route::prefix('ticket')->group(function () {
        Route::get('', [TicketController::class, 'index'])->name('ticket.index');
        Route::get('/create', [TicketController::class, 'create'])->name('ticket.create');
        Route::get('/view', [TicketController::class, 'view'])->name('ticket.view');
        Route::post('/store', [TicketController::class, 'store'])->name('ticket.store');
        Route::get('{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
        Route::put('{ticket}/update', [TicketController::class, 'update'])->name('ticket.update');
        Route::get('{ticket}/updateStatus', [TicketController::class, 'updateStatus'])->name('ticket.updateStatus');
        Route::get('{ticket}/delete', [TicketController::class, 'delete'])->name('ticket.delete');
    });

    // Tiket Opsi Satuan
    Route::prefix('ticketcat')->group(function () {
        Route::get('', [TicketKategoriController::class, 'index'])->name('ticketcat.index');
        Route::get('/create', [TicketKategoriController::class, 'create'])->name('ticketcat.create');
        Route::post('/store', [TicketKategoriController::class, 'store'])->name('ticketcat.store');
        Route::get('{ticketcat}/edit', [TicketKategoriController::class, 'edit'])->name('ticketcat.edit');
        Route::put('{ticketcat}/update', [TicketKategoriController::class, 'update'])->name('ticketcat.update');
        Route::get('{ticketcat}/delete', [TicketKategoriController::class, 'delete'])->name('ticketcat.delete');
    });

    // Web Setting
    Route::prefix('websetting')->group(function () {
        Route::post('/updatesetting', [SettingsController::class, 'settings'])->name('websetting.settings');
        Route::post('/updatetripay', [SettingsController::class, 'updatetripay'])->name('websetting.updatetripay');
        Route::post('/updatewa', [SettingsController::class, 'wasettings'])->name('websetting.wasettings');
        Route::post('/updatewamessages', [SettingsController::class, 'wamessages'])->name('websetting.wamessages');
    });


    Route::get('/pdf', [PDFController::class, 'PDFInventaris'])->name('pdf.inventaris');
    Route::get('/pdf/ticketcat', [PDFController::class, 'PDFTicketKategori'])->name('pdf.ticketcat');

    //Indoregion
    Route::prefix('region')->group(function () {
        Route::post('kota', [IndoRegionController::class, 'kota'])->name('region.kota');
        Route::post('kecamatan', [IndoRegionController::class, 'kecamatan'])->name('region.kecamatan');
        Route::post('kelurahan', [IndoRegionController::class, 'kelurahan'])->name('region.kelurahan');
    });

    // Laporan
    Route::prefix('laporan')->group(function () {
        Route::get('', [LaporanController::class, 'index'])->name('laporan.index');
    });
});
