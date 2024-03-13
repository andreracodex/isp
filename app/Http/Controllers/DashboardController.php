<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = Setting::all();

        // Biaya pasang
        $biaya_pasang = Number::currency(count_order(), in: 'IDR', locale: 'id');
        $biaya_pasang_last = Number::currency(count_last_order(), in: 'IDR', locale: 'id');
        $biaya_pasang_real = count_order();
        $biaya_pasang_last_real = count_last_order();
        // Customer New
        $new_customer = new_customer();
        $last_new_customer = last_customer();
        // Pendapatan
        $pendapatan = Number::currency(count_pendapatan(), in: 'IDR', locale: 'id');
        $pendapatan_last = Number::currency(count_pendapatan_last(), in: 'IDR', locale: 'id');
        $pendapatan_real = count_pendapatan();
        $pendapatan_last_real = count_pendapatan_last();

        // Pengeluaran
        $pengeluaran = Number::currency(count_pengeluaran(), in: 'IDR', locale: 'id');
        $pengeluaran_last = Number::currency(count_pengeluaran_last(), in: 'IDR', locale: 'id');
        $pengeluaran_real = count_pengeluaran();
        $pengeluaran_last_real = count_pengeluaran_last();

        // Tagihan Belum Terbayar
        $tagihan = Number::currency(count_tagihan(), in: 'IDR', locale: 'id');
        $tagihan_last = Number::currency(count_tagihan_last(), in: 'IDR', locale: 'id');
        $tagihan_count = count_tagihan();

        $pembayaran = Number::currency(count_pembayaran(), in: 'IDR', locale: 'id');
        $pembayaran_last = Number::currency(count_pembayaran_last(), in: 'IDR', locale: 'id');
        $pembayaran_count = count_pembayaran();

        $income = pemasukan_chart();
        $outcome = pengeluaran_chart();

        return view(
            'backend.pages.dashboard',
            compact(
                'profile',
                'biaya_pasang',
                'biaya_pasang_last',
                'biaya_pasang_real',
                'biaya_pasang_last_real',
                'new_customer',
                'last_new_customer',
                'pendapatan',
                'pendapatan_last',
                'pendapatan_real',
                'pendapatan_last_real',
                'pengeluaran',
                'pengeluaran_last',
                'pengeluaran_real',
                'pengeluaran_last_real',
                'income',
                'outcome',
                'tagihan',
                'tagihan_last',
                'tagihan_count',
                'pembayaran',
                'pembayaran_last',
                'pembayaran_count'
            )
        );
    }
}
