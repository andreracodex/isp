<?php // routes/breadcrumbs.php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('dashboard'));
});
// Customers
Breadcrumbs::for('customer.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Pelanggan', route('customer.index'));
});
Breadcrumbs::for('customer.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Pelanggan', route('customer.create'));
});
Breadcrumbs::for('customer.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Pelanggan', route('customer.store'));
});


// Paket
Breadcrumbs::for('paket.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Paket Internet', route('paket.index'));
});
Breadcrumbs::for('paket.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Paket Internet', route('paket.create'));
});
Breadcrumbs::for('paket.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Paket Internet', route('paket.store'));
});


// Location Management
Breadcrumbs::for('location.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Lokasi Server', route('location.index'));
});

Breadcrumbs::for('location.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Lokasi Server', route('location.create'));
});


// Wa Page
Breadcrumbs::for('wa.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Whatsapp Bot', route('wa.index'));
});

Breadcrumbs::for('wa.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Whatsapp Bot', route('wa.create'));
});

Breadcrumbs::for('wa.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Whatsapp Bot', route('wa.store'));
});

// Inventaris
Breadcrumbs::for('inve.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Inventaris', route('inve.index'));
});

Breadcrumbs::for('inve.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Inventaris', route('inve.create'));
});

Breadcrumbs::for('inve.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Inventaris', route('inve.store'));
});
