<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $profile = Setting::all();
        $biaya_pasang = count_order();
        $biaya_pasang_last = count_last_order();
        $new_customer = new_customer();
        $last_new_customer = last_customer();
        $selisih_customer = ($new_customer - $last_new_customer);
        $selisih_biaya = ($biaya_pasang - $biaya_pasang_last);

        return view('backend.pages.dashboard' ,
            compact('profile', 'biaya_pasang', 'new_customer', 'selisih_customer', 'selisih_biaya')
        );
    }
}
