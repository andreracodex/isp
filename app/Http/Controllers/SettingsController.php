<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Sessions;
use App\Models\Setting;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Stevebauman\Location\Facades\Location;
use Yajra\DataTables\Facades\DataTables;

class SettingsController extends Controller
{
    public function index(Request $request){
        $ip = $request->ip();
        if($ip == '127.0.0.1'){
            $ip = '110.137.100.105';
        }else{
            $ip = $ip;
        }
        $roles = Role::get();
        $ip = Location::get($ip);
        $profile = Setting::all();
        $websetting = Setting::where('name', 'title_text')
            ->orWhere('name', 'subtitle_text')
            ->orWhere('name', 'site_currency')
            ->orWhere('name', 'site_currency_symbol')
            ->orWhere('name', 'company_name')
            ->orWhere('name', 'company_address')
            ->orWhere('name', 'company_city')
            ->orWhere('name', 'company_state')
            ->orWhere('name', 'company_zipcode')
            ->orWhere('name', 'company_telephone')
            ->orWhere('name', 'company_email')
            ->get();
        $usersetting = UserSetting::all();
        $sess = Sessions::where('user_id', Auth::user()->id)->get();

        return view('backend.pages.setting.index', compact('profile', 'usersetting', 'sess', 'ip', 'roles', 'websetting'));
    }

    public function store() {

    }
}
