<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $profile = Setting::all();
        return view('backend.pages.dashboard' ,compact('profile'));
    }
}
