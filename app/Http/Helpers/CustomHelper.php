<?php

use App\Models\Customer;
use App\Models\Order;
use App\Models\Setting;
use Carbon\Carbon;

function count_order() {
    $now = Carbon::now();
    $sumBiayaPasangBulanIni = Order::whereMonth('created_at', $now->month)->sum('biaya_pasang');
    return $sumBiayaPasangBulanIni;
}

function count_last_order() {
    $now = Carbon::now()->subMonths(1);
    $sumBiayaPasangBulanIni = Order::whereMonth('created_at', $now->month)->sum('biaya_pasang');
    return $sumBiayaPasangBulanIni;
}

function new_customer() {
    $now = Carbon::now();
    $sumNewCustomer = Customer::where('is_new', 1)->whereMonth('created_at', $now->month)->count();
    return $sumNewCustomer;
}

function last_customer() {
    $now = Carbon::now()->subMonths(1);
    $sumLastNewCustomer = Customer::where('is_new', 1)->whereMonth('created_at', $now->month)->count();
    return $sumLastNewCustomer;
}
