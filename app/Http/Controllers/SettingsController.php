<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Sessions;
use App\Models\Setting;
use App\Models\SettingsWA;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Sabberworm\CSS\Settings;
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
        $users = User::has('roles')->get();
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
        $webwa = SettingsWA::all();
        $settingwatoken = Setting::where('name', 'wa_token')->get();
        $settingtripay = Setting::where('name', 'tripay_api_key')
            ->orWhere('name', 'tripay_api_secret')
            ->orWhere('name', 'tripay_api_debug')
            ->orWhere('name', 'tripay_merchant_code')
            ->get();
        $usersetting = UserSetting::all();
        $sess = Sessions::where('user_id', Auth::user()->id)->get();

        return view('backend.pages.setting.index', compact('users', 'profile', 'usersetting', 'sess', 'ip', 'roles', 'websetting', 'webwa', 'settingwatoken', 'settingtripay'));
    }

    public function store() {

    }

    public function roleedit(User $user, $setting){
        $profile = Setting::all();
        $users = User::has('roles')->where('id', $setting)->get();
        $roles = Role::get();

        return view('backend.pages.setting.partials.roles.form-edit-roles', compact('setting', 'users', 'user', 'profile', 'roles'));
    }

    public function roleupdate($setting, Request $request){
        $user = User::find($setting);
        $role = $request->input('roles');
        $user->roles()->sync($role);

        return redirect()->route('settings.index')->with('success','User Assign Role Updated');
    }

    public function settings(Request $request)
    {
        $settings = $request->input('settings');

        foreach ($settings as $settingId => $value) {
            $setting = Setting::find($settingId);
            if ($setting) {
                $setting->value = $value;
                $setting->save();
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function updatetripay(Request $request)
    {
        $settings = $request->input('settings');

        foreach ($settings as $settingId => $value) {
            $setting = Setting::find($settingId);

            if ($setting) {
                // Check the type of input field
                if ($setting->name == 'tripay_api_debug') {
                    // For toggle input
                    $setting->value = ($value == 'on') ? 'on' : 'off';
                } else {
                    // For text input
                    $setting->value = $value;
                }

                $setting->save();
            }
        }

        return redirect()->back()->with('success', 'Tripay Settings updated successfully.');
    }

    public function wasettings(Request $request){
        $settings = $request->input('is_active');
        $seting_lengkap = [];
        for ($i = 1; $i <= 7; $i++) {
            $seting_lengkap[$i] = isset($settings[$i]) ? $settings[$i] : "off";
        }
        foreach ($seting_lengkap as $settingId => $value) {
            $wa = SettingsWA::find($settingId);

            if ($wa) {
                if($value == "on" || $value == "ON"){
                    $nilai = 1;
                }else{
                    $nilai = 0;
                }
                $wa->is_active = $nilai;
                $wa->save();
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
