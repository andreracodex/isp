<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = Setting::all();

        // Biaya pasang
        $biaya_pasang_conversion = Number::currency(count_order(), in: 'IDR', locale: 'us');
        $biaya_pasang_last_conversion = Number::currency(count_last_order(), in: 'IDR', locale: 'us');
        $biaya_pasang = count_order();
        $biaya_pasang_last = count_last_order();
        // Customer New
        $new_customer = new_customer();
        $last_new_customer = last_customer();
        // Pendapatan
        $pendapatan = Number::currency(count_pendapatan(), in: 'IDR', locale: 'us');
        $pendapatan_last = Number::currency(count_pendapatan_last(), in: 'IDR', locale: 'us');
        // Pengeluaran
        $pengeluaran = Number::currency(count_pengeluaran(), in: 'IDR', locale: 'us');
        $pengeluaran_last = Number::currency(count_pengeluaran_last(), in: 'IDR', locale: 'us');

        return view(
            'backend.pages.dashboard',
            compact('profile', 'biaya_pasang', 'biaya_pasang_conversion', 'biaya_pasang_last', 'biaya_pasang_last_conversion', 'new_customer', 'last_new_customer', 'pendapatan', 'pendapatan_last', 'pengeluaran')
        );
    }
}
