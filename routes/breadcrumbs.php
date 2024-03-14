<?php // routes/breadcrumbs.php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('dashboard'));
});

// Bank
Breadcrumbs::for('bank.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Bank', route('bank.index'));
});
Breadcrumbs::for('bank.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Bank', route('bank.create'));
});
Breadcrumbs::for('bank.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Bank', route('bank.edit', 'bank'));
});
Breadcrumbs::for('bank.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Bank', route('bank.store'));
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
Breadcrumbs::for('customer.view', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Detail Pelanggan', route('customer.view', 'customer'));
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
Breadcrumbs::for('paket.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Paket Internet', route('paket.store', 'paket'));
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
Breadcrumbs::for('location.view', function (BreadcrumbTrail $trail): void {
    $trail->push('Detail Lokasi Server', route('location.view', 'location'));
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
Breadcrumbs::for('inve.view', function (BreadcrumbTrail $trail): void {
    $trail->push('Detail Inventaris', route('inve.view', 'inve'));
});
Breadcrumbs::for('inve.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Inventaris', route('inve.edit', 'inve'));
});
Breadcrumbs::for('inve.update', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Update Inventaris', route('inve.update', 'inve'));
});

// Inventaris Satuan
Breadcrumbs::for('invesatuan.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Satuan', route('invesatuan.index'));
});
Breadcrumbs::for('invesatuan.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Satuan', route('invesatuan.create'));
});
Breadcrumbs::for('invesatuan.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Satuan', route('invesatuan.edit', 'invesatuan'));
});
Breadcrumbs::for('invesatuan.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Satuan', route('invesatuan.store'));
});
Breadcrumbs::for('invesatuan.update', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Update Satuan', route('invesatuan.update', 'invesatuan'));
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
Breadcrumbs::for('order.view', function (BreadcrumbTrail $trail): void {
    $trail->push('Detail Tagihan', route('order.view', 'order'));
});
Breadcrumbs::for('order.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Tagihan', route('order.edit', 'order'));
});
Breadcrumbs::for('order.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Tagihan', route('order.store'));
});

// Periode Tagihan
Breadcrumbs::for('periode.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Periode Tagihan', route('periode.index'));
});
Breadcrumbs::for('periode.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Periode Tagihan', route('periode.create'));
});
Breadcrumbs::for('periode.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Periode Tagihan', route('periode.edit', 'periode'));
});
Breadcrumbs::for('periode.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Periode Tagihan', route('periode.store'));
});

// Employee
Breadcrumbs::for('employee.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Karyawan', route('employee.index'));
});
Breadcrumbs::for('employee.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Karyawan', route('employee.create'));
});
Breadcrumbs::for('employee.view', function (BreadcrumbTrail $trail): void {
    $trail->push('View Karyawan', route('employee.view', 'employee'));
});
Breadcrumbs::for('employee.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Karyawan', route('employee.edit', 'employee'));
});
Breadcrumbs::for('employee.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Karyawan', route('employee.store'));
});

// Ticket
Breadcrumbs::for('ticket.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Ticket', route('ticket.index'));
});
Breadcrumbs::for('ticket.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Ticket', route('ticket.create'));
});
Breadcrumbs::for('ticket.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Ticket', route('ticket.edit', 'ticket'));
});
Breadcrumbs::for('ticket.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Ticket', route('ticket.store'));
});

// Payment Method
Breadcrumbs::for('paymenttype.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Metode Pembayaran', route('paymenttype.index'));
});
Breadcrumbs::for('paymenttype.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Tambah Metode Pembayaran', route('paymenttype.create'));
});
Breadcrumbs::for('paymenttype.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Metode Pembayaran', route('paymenttype.edit', 'paymenttype'));
});
Breadcrumbs::for('paymenttype.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Simpan Metode Pembayaran', route('paymenttype.store'));
});
Breadcrumbs::for('paymenttype.update', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');
    $trail->push('Update Metode Pembayaran', route('paymenttype.update', 'paymenttype'));
});
