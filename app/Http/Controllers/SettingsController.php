<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use App\Models\Setting;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;

class SettingsController extends Controller
{
    public function index(Request $request){
        $ip = $request->ip();
        if($ip == '127.0.0.1'){
            $ip = '110.137.100.105';
        }else{
            $ip = $ip;
        }
        $ip = Location::get($ip);
        $profile = Setting::all();
        $usersetting = UserSetting::all();
        $sess = Sessions::where('user_id', Auth::user()->id)->get();
        return view('backend.pages.setting.profile.profile', compact('profile', 'usersetting', 'sess', 'ip'));
    }
}
