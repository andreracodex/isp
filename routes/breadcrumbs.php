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
Breadcrumbs::for('paket.edit', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Edit Paket Internet', route('paket.edit', 'paket'));
});
Breadcrumbs::for('paket.update', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Update Paket Internet', route('paket.update', 'paket'));
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
Breadcrumbs::for('location.edit', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Edit Lokasi Server', route('location.edit', 'location'));
});
Breadcrumbs::for('location.update', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Update Lokasi Server', route('location.update', 'location'));
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
Breadcrumbs::for('inve.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Inventaris', route('inve.edit', 'inve'));
});
Breadcrumbs::for('inve.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Inventaris', route('inve.store'));
});

// Order Customer
Breadcrumbs::for('order.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Order', route('order.index'));
});
Breadcrumbs::for('order.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Order', route('order.create'));
});
Breadcrumbs::for('order.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Order', route('order.edit', 'order'));
});
Breadcrumbs::for('order.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Order', route('order.store'));
});
