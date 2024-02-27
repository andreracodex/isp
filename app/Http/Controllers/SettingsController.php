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
        if ($request->ajax()){
            $data_table = Employee::orderBy('nama_karyawan', 'ASC')->get();
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('emp_id', function (Employee $emp) {
                return $emp->id;
            })
            ->addColumn('action', function (Employee $emp) {
                return "
                <a href=". route('employee.view', $emp->id) ." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('employee.edit', $emp->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <a href=". route('employee.destroy', $emp->id) ." class='avtar avtar-xs btn-link-danger btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete Data'><i class='fa fa-trash-alt'></i></a>
            ";
            })
            ->make(true);
        }

        $ip = $request->ip();
        if($ip == '127.0.0.1'){
            $ip = '110.137.100.105';
        }else{
            $ip = $ip;
        }
        $roles = Role::get();
        $ip = Location::get($ip);
        $profile = Setting::all();
        $usersetting = UserSetting::all();
        $sess = Sessions::where('user_id', Auth::user()->id)->get();
        $employee = Employee::all();
        $emp_active = Employee::where('is_active', 1)->count();
        return view('backend.pages.setting.profile.profile', compact('profile', 'usersetting', 'sess', 'ip', 'employee', 'emp_active', 'roles'));
    }

    public function store() {

    }
}
