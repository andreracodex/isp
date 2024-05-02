<?php

namespace App\Http\Helpers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use Carbon\Carbon;

function count_order()
{
    $now = Carbon::now();
    $order = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', $now->month)->sum('biaya_pasang');
    return $order;
}

function count_last_order()
{
    $now = Carbon::now()->subMonths(1);
    $lastorder = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', $now->month)->sum('biaya_pasang');
    return $lastorder;
}

function count_pendapatan()
{
    $now = Carbon::now();
    $bulan_paket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereYear('order_details.due_date', date('Y'))->whereMonth('order_details.due_date', $now->month)->where('order_details.is_active', 1)->sum('pakets.harga_paket');
    // $bulan_pasang = Order::whereMonth('due_date', $now->month)->where('is_active', 1)->sum('biaya_pasang');
    $pendapatan = $bulan_paket;
    return $pendapatan;
}

function count_pendapatan_last()
{
    $now = Carbon::now()->subMonths(1);
    $bulan_paket_last = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereYear('order_details.due_date', date('Y'))->whereMonth('order_details.due_date', $now->month)->where('order_details.is_active', 1)->sum('pakets.harga_paket');
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

// Tagihan bulan ini
function count_tagihan()
{
    $now = Carbon::now();
    $tagihan = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereYear('order_details.due_date', date('Y'))->whereMonth('order_details.due_date', $now->month)->where('order_details.is_payed', 0)->sum('pakets.harga_paket');
    return $tagihan;
}

// Tagihan bulan lalu
function count_tagihan_last()
{
    $now = Carbon::now()->subMonths(1);
    $lasttagihan = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereYear('order_details.due_date', date('Y'))->whereMonth('order_details.due_date', $now->month)->where('order_details.is_payed', 0)->sum('pakets.harga_paket');
    return $lasttagihan;
}

// Pembayaran bulan ini
function count_pembayaran()
{
    $now = Carbon::now();
    $pembayaran = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereYear('order_details.due_date', date('Y'))->whereMonth('order_details.due_date', $now->month)->where('order_details.is_payed', 1)->sum('pakets.harga_paket');
    return $pembayaran;
}

// Pembayaran bulan lalu
function count_pembayaran_last()
{
    $now = Carbon::now()->subMonths(1);
    $lastpembayaran = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereYear('order_details.due_date', date('Y'))->whereMonth('order_details.due_date', $now->month)->where('order_details.is_payed', 1)->sum('pakets.harga_paket');
    return $lastpembayaran;
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
    $JanPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 1)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $JanPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 1)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $FebPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 2)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $FebPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 2)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $MarPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 3)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $MarPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 3)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $AprPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 4)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $AprPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 4)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $MeiPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 5)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $MeiPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 5)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $JunPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 6)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $JunPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 6)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $JulPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 7)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $JulPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 7)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $AguPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 8)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $AguPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 8)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $SepPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 9)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $SepPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 9)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $OktPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 10)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $OktPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 10)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $NovPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 11)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $NovPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 11)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

    $DesPasang = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->whereMonth('order_details.due_date', 12)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('orders.biaya_pasang');
    $DesPaket = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->leftJoin('pakets', 'orders.paket_id', '=', 'pakets.id')->whereMonth('order_details.due_date', 12)->whereYear('order_details.due_date', date('Y'))->where('order_details.is_active', 1)->sum('pakets.harga_paket');

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

function convert_phone($phoneNumber)
{
    // Remove non-numeric characters from the phone number
    $cleanedPhoneNumber = preg_replace('/\D/', '', $phoneNumber);

    // Check if the phone number starts with '62'
    if (substr($cleanedPhoneNumber, 0, 2) === '62') {
        // Convert the phone number to the local format starting with '08'
        $convertedNumber = '0' . substr($cleanedPhoneNumber, 2);
        return $convertedNumber;
    } else {
        // Return the phone number as is if it does not start with '+62'
        return $phoneNumber;
    }
}

function belum_bayar()
{
    $belum_bayar = OrderDetail::leftJoin('orders', 'order_details.order_id', 'orders.id')
        ->leftJoin('customers', 'orders.customer_id', 'customers.id')
        ->leftJoin('pakets', 'orders.paket_id', 'pakets.id')
        ->where('order_details.is_payed', 0)
        ->orderBy('order_details.created_at', 'desc')->take(10)->get();

    return $belum_bayar;
}
