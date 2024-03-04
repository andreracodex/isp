<?php

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Setting;
use Carbon\Carbon;

function count_order()
{
    $now = Carbon::now();
    $order = Order::whereMonth('created_at', $now->month)->sum('biaya_pasang');
    return $order;
}

function count_last_order()
{
    $now = Carbon::now()->subMonths(1);
    $lastorder = Order::whereMonth('created_at', $now->month)->sum('biaya_pasang');
    return $lastorder;
}

function count_pendapatan()
{
    $now = Carbon::now();
    $pendapatan = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.created_at', $now->month)->sum('pakets.harga_paket');
    return $pendapatan;
}

function count_pendapatan_last()
{
    $now = Carbon::now()->subMonths(1);
    $pendapatan_last = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.created_at', $now->month)->sum('pakets.harga_paket');
    return $pendapatan_last;
}

function count_pengeluaran()
{
    $pengeluaran = Employee::where('is_active', 1)->sum('gaji_pokok');
    return $pengeluaran;
}

function count_pengeluaran_last()
{
    $pengeluaran_last = Employee::where('is_active', 1)->sum('gaji_pokok');
    return $pengeluaran_last;
}


function new_customer()
{
    $now = Carbon::now();
    $newcustomer = Customer::where('is_new', 1)->whereMonth('created_at', $now->month)->count();
    return $newcustomer;
}

function last_customer()
{
    $now = Carbon::now()->subMonths(1);
    $lastcustomer = Customer::where('is_new', 1)->whereMonth('created_at', $now->month)->count();
    return $lastcustomer;
}


function pengeluaran_chart()
{
    $Jan = Order::whereMonth('created_at', 1)->where('')->sum();
    $Feb = Order::whereMonth('created_at', 2)->where()->count();
    $Mar = Order::whereMonth('created_at', 3)->get()->count();
    $Apr = Order::whereMonth('created_at', 4)->get()->count();
    $Mei = Order::whereMonth('created_at', 5)->get()->count();
    $Jun = Order::whereMonth('created_at', 6)->get()->count();
    $Jul = Order::whereMonth('created_at', 7)->get()->count();
    $Agu = Order::whereMonth('created_at', 8)->get()->count();
    $Sep = Order::whereMonth('created_at', 9)->get()->count();
    $Okt = Order::whereMonth('created_at', 10)->get()->count();
    $Nov = Order::whereMonth('created_at', 11)->get()->count();
    $Des = Order::whereMonth('created_at', 12)->get()->count();

    $chart_bulan = array(
        $Jan, $Feb, $Mar, $Apr,
        $Mei, $Jun, $Jul, $Agu,
        $Sep, $Okt, $Nov, $Des
    );

    return $chart_bulan;
}

function pemasukan_chart(){
    $Jan = Order::whereMonth('due_date', 1)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Feb = Order::whereMonth('due_date', 2)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Mar = Order::whereMonth('due_date', 3)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Apr = Order::whereMonth('due_date', 4)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Mei = Order::whereMonth('due_date', 5)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Jun = Order::whereMonth('due_date', 6)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Jul = Order::whereMonth('due_date', 7)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Agu = Order::whereMonth('due_date', 8)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Sep = Order::whereMonth('due_date', 9)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Okt = Order::whereMonth('due_date', 10)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Nov = Order::whereMonth('due_date', 11)->whereYear('due_date', date('Y'))->sum('biaya_pasang');
    $Des = Order::whereMonth('due_date', 12)->whereYear('due_date', date('Y'))->sum('biaya_pasang');

    $chart_bulan = array(
        $Jan, $Feb, $Mar, $Apr,
        $Mei, $Jun, $Jul, $Agu,
        $Sep, $Okt, $Nov, $Des
    );

    return $chart_bulan;
}
