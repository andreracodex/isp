<?php

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Setting;
use Carbon\Carbon;

function count_order()
{
    $now = Carbon::now();
    $order = Order::whereYear('due_date', date('Y'))->whereMonth('due_date', $now->month)->where('is_active', 1)->sum('biaya_pasang');
    return $order;
}

function count_last_order()
{
    $now = Carbon::now()->subMonths(1);
    $lastorder = Order::whereYear('due_date', date('Y'))->whereMonth('due_date', $now->month)->where('is_active', 1)->sum('biaya_pasang');
    return $lastorder;
}

function count_pendapatan()
{
    $now = Carbon::now();
    $bulan_paket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereYear('due_date', date('Y'))->whereMonth('orders.due_date', $now->month)->where('orders.is_active', 1)->sum('pakets.harga_paket');
    // $bulan_pasang = Order::whereMonth('due_date', $now->month)->where('is_active', 1)->sum('biaya_pasang');
    $pendapatan = $bulan_paket;
    return $pendapatan;
}

function count_pendapatan_last()
{
    $now = Carbon::now()->subMonths(1);
    $bulan_paket_last = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereYear('due_date', date('Y'))->whereMonth('orders.due_date', $now->month)->where('orders.is_active', 1)->sum('pakets.harga_paket');
    // $bulan_pasang_lasts = Order::whereMonth('due_date', $now->month)->whereYear('orders.due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $pendapatan_last = $bulan_paket_last;
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
    $JanPasang = Order::whereMonth('due_date', 1)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $JanPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 1)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $FebPasang = Order::whereMonth('due_date', 2)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $FebPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 2)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $MarPasang = Order::whereMonth('due_date', 3)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $MarPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 3)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $AprPasang = Order::whereMonth('due_date', 4)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $AprPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 4)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $MeiPasang = Order::whereMonth('due_date', 5)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $MeiPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 5)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $JunPasang = Order::whereMonth('due_date', 6)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $JunPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 6)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $JulPasang = Order::whereMonth('due_date', 7)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $JulPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 7)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $AguPasang = Order::whereMonth('due_date', 8)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $AguPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 8)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $SepPasang = Order::whereMonth('due_date', 9)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $SepPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 9)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $OktPasang = Order::whereMonth('due_date', 10)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $OktPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 10)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $NovPasang = Order::whereMonth('due_date', 11)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $NovPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 11)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $DesPasang = Order::whereMonth('due_date', 12)->whereYear('due_date', date('Y'))->where('is_active', 1)->sum('biaya_pasang');
    $DesPaket = Order::leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('orders.due_date', 12)->whereYear('orders.due_date', date('Y'))->where('orders.is_active', 1)->sum('pakets.harga_paket');

    $Jan = $JanPasang+$JanPaket;
    $Feb = $FebPasang+$FebPaket;
    $Mar = $MarPasang+$MarPaket;
    $Apr = $AprPasang+$AprPaket;
    $Mei = $MeiPasang+$MeiPaket;
    $Jun = $JunPasang+$JunPaket;
    $Jul = $JulPasang+$JulPaket;
    $Agu = $AguPasang+$AguPaket;
    $Sep = $SepPasang+$SepPaket;
    $Okt = $OktPasang+$OktPaket;
    $Nov = $NovPasang+$NovPaket;
    $Des = $DesPasang+$DesPaket;

    $chart_bulan = array(
        $Jan, $Feb, $Mar, $Apr,
        $Mei, $Jun, $Jul, $Agu,
        $Sep, $Okt, $Nov, $Des
    );

    return $chart_bulan;
}
