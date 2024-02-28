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
Breadcrumbs::for('customer.edit', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Edit Pelanggan', route('customer.edit', 'customer'));
});
Breadcrumbs::for('customer.update', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Update Pelanggan', route('customer.update', 'customer'));
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

// Inventaris Kategori
Breadcrumbs::for('invekategori.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Kategori Inventaris', route('invekategori.index'));
});
Breadcrumbs::for('invekategori.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Kategori Inventaris', route('invekategori.create'));
});
Breadcrumbs::for('invekategori.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Kategori Inventaris', route('invekategori.edit', 'invekategori'));
});
Breadcrumbs::for('invekategori.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Kategori Inventaris', route('invekategori.store'));
});
Breadcrumbs::for('invekategori.update', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Update Kategori Inventaris', route('invekategori.update', 'invekategori'));
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
Breadcrumbs::for('inve.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Inventaris', route('inve.edit', 'inve'));
});
Breadcrumbs::for('inve.update', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Update Inventaris', route('inve.update', 'inve'));
});

// Order Customer
Breadcrumbs::for('order.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tagihan', route('order.index'));
});
Breadcrumbs::for('order.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Tagihan', route('order.create'));
});
Breadcrumbs::for('order.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Tagihan', route('order.edit', 'order'));
});
Breadcrumbs::for('order.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Tagihan', route('order.store'));
});
