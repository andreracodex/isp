<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use App\Models\District;
use App\Models\Regency;
use App\Models\Village;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request){
        $profile = Setting::all();
        $employee = Employee::all();
        $emp_active = Employee::where('is_active', 1)->count();
        $data_table = Employee::orderBy('nama_karyawan', 'ASC')->get();

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('emp_id', function (Employee $emp) {
                return $emp->id;
            })
            ->editColumn('gender', function (Employee $emp) {
                if ($emp->gender == '1') {
                    return 'male';
                } else {
                    return 'female';
                }
            })
            ->addColumn('email', function (Employee $emp) {
                return $emp->user->email;
            })
            ->addColumn('action', function (Employee $emp) {
                return "
                <a href=". route('employee.view', $emp->id) ." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('employee.edit', $emp->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusEmp' data-id='$emp->id'><i class='fa fa-trash-alt'></i></button>
            ";
            })
            ->make(true);
        }

        return view('backend.pages.employee.index', compact('employee', 'emp_active', 'profile'));
    }

    public function create()
    {
        $employee = new Employee;
        $lokasi = Location::all();
        $profile = Setting::all();
        $kotas = Regency::where('province_id', '35')->orderBy('name', 'ASC')->get();
        $districts = District::all();
        $villages = Village::all();

        return view('backend.pages.employee.create',
            compact('profile', 'employee', 'lokasi', 'kotas', 'districts', 'villages')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_karyawan' => 'required',
            'nomor_ktp' => 'required',
            'gender' => 'required',
            'nomor_telephone' => 'required|min:10|max:14',
            'email' => 'required|email:dns|unique:users',
        ]);

        if (!$validated) {
            return redirect()->route('employee.index')->with('error','Property is not valid .');
        }

        $user = User::create([
            'name' => $request->nama_karyawan,
            'user_name' => $request->nama_karyawan,
            'email' => $request->email,
            'password' => bcrypt('12345678'),
            'user_type' => 'admin',
        ]);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        Employee::create([
            'user_id' => $user->id,
            'nama_karyawan' => $request->nama_karyawan,
            'nomor_ktp' => $request->nomor_ktp ?? 0,
            'gender' => $request->gender,
            'gaji_pokok' => $request->gaji_pokok,
            'alamat_karyawan' => $request->alamat_karyawan,
            'kodepos_karyawan' => $request->kodepos_karyawan,
            'nomor_telephone' => $request->nomor_telephone,
            'kelurahan_id' => $request->kelurahan,
            'is_active' => $is_active,
        ]);

        return redirect()->route('employee.index')->with('success','Berhasil Tambah Karyawan.');
    }

    public function view(Employee $emp)
    {
        $employee = Employee::find($emp->id);
        $profile = Setting::all();
        $kotas = Regency::where('province_id', '35')->get();
        $districts = District::all();
        $villages = Village::all();

        return view('backend.pages.employee.view',
            compact('profile', 'employee', 'kotas', 'districts', 'villages')
        );
    }

    public function edit(Employee $emp)
    {
        $employee = Employee::find($emp->id);
        $profile = Setting::all();
        $kotas = Regency::where('province_id', '35')->get();
        $districts = District::all();
        $villages = Village::all();

        return view('backend.pages.employee.edit',
            compact('profile', 'employee', 'kotas', 'districts', 'villages')
        );
    }

    public function update(Request $request, Employee $emp)
    {
        $validated = $request->validate([
            'nama_karyawan' => 'required',
            'nomor_ktp' => 'required',
            'gender' => 'required',
            'nomor_telephone' => 'required|min:10|max:14',
            'email' => 'required|email:dns',
        ]);

        if (!$validated) {
            return redirect()->route('employee.index')->with('error','Property is not valid .');
        }

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $user = User::find($emp->user_id);
        $user->update([
            'name' => $request->nama_karyawan,
            'email' => $request->email,
            'user_type' => 'admin',
        ]);

        $emp->update([
            'nama_karyawan' => $request->nama_karyawan,
            'nomor_ktp' => $request->nomor_ktp ?? 0,
            'gender' => $request->gender,
            'alamat_karyawan' => $request->alamat_karyawan,
            'kodepos_karyawan' => $request->kodepos_karyawan,
            'nomor_telephone' => $request->nomor_telephone,
            'gaji_pokok' => $request->gaji_pokok,
            'kelurahan_id' => $request->kelurahan,
            'is_active' => $is_active,
        ]);

        return redirect()->route('employee.index')->with('success', 'Berhasil Edit Karyawan.');
    }

    public function delete(String $id)
    {
        $emp = Employee::find($id);
        if($emp){
            Employee::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        }else{
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }

}
