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
