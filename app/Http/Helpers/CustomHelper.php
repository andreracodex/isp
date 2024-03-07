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
    $Jan = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Feb = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Mar = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Apr = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Mei = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Jun = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Jul = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Agu = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Sep = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Okt = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Nov = Employee::where('is_active', 1)->sum('gaji_pokok');
    $Des = Employee::where('is_active', 1)->sum('gaji_pokok');

    $chart_bulan = array(
        $Jan, $Feb, $Mar, $Apr,
        $Mei, $Jun, $Jul, $Agu,
        $Sep, $Okt, $Nov, $Des
    );

    return $chart_bulan;
}

function pemasukan_chart()
{
    $Jan = Order::whereMonth('due_date', 1)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 1)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Feb = Order::whereMonth('due_date', 2)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 2)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Mar = Order::whereMonth('due_date', 3)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 3)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Apr = Order::whereMonth('due_date', 4)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 4)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Mei = Order::whereMonth('due_date', 5)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 5)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Jun = Order::whereMonth('due_date', 6)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 6)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Jul = Order::whereMonth('due_date', 7)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 7)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Agu = Order::whereMonth('due_date', 8)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 8)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Sep = Order::whereMonth('due_date', 9)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 9)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Okt = Order::whereMonth('due_date', 10)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 10)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Nov = Order::whereMonth('due_date', 11)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 11)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');
    $Des = Order::whereMonth('due_date', 12)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang') + Order::leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')->whereMonth('orders.due_date', 12)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $chart_bulan = array(
        $Jan, $Feb, $Mar, $Apr,
        $Mei, $Jun, $Jul, $Agu,
        $Sep, $Okt, $Nov, $Des
    );

    return $chart_bulan;
}
