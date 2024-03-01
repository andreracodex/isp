<?php

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Setting;
use Carbon\Carbon;

function count_order() {
    $now = Carbon::now();
    $order = Order::whereMonth('created_at', $now->month)->sum('biaya_pasang');
    return $order;
}

function count_last_order() {
    $now = Carbon::now()->subMonths(1);
    $lastorder = Order::whereMonth('created_at', $now->month)->sum('biaya_pasang');
    return $lastorder;
}

function count_pendapatan() {
    $now = Carbon::now();
    $pendapatan = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.created_at', $now->month)->sum('pakets.harga_paket');
    return $pendapatan;
}

function count_pendapatan_last() {
    $now = Carbon::now()->subMonths(1);
    $pendapatan_last = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.created_at', $now->month)->sum('pakets.harga_paket');
    return $pendapatan_last;
}

function count_pengeluaran() {
    $pengeluaran = Employee::where('is_active', 1)->sum('gaji_pokok');
    return $pengeluaran;
}

function count_pengeluaran_last() {
    $pengeluaran_last = Employee::where('is_active', 1)->sum('gaji_pokok');
    return $pengeluaran_last;
}


function new_customer() {
    $now = Carbon::now();
    $newcustomer = Customer::where('is_new', 1)->whereMonth('created_at', $now->month)->count();
    return $newcustomer;
}

function last_customer() {
    $now = Carbon::now()->subMonths(1);
    $lastcustomer = Customer::where('is_new', 1)->whereMonth('created_at', $now->month)->count();
    return $lastcustomer;
}
