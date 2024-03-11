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

        $employee = Employee::create([
            'user_id' => $user->id,
            'nama_karyawan' => $request->nama_karyawan,
            'nomor_ktp' => $request->nomor_ktp ?? 0,
            'gender' => $request->gender,
            'alamat_karyawan' => $request->alamat_karyawan,
            'kodepos_karyawan' => $request->kodepos_karyawan,
            'nomor_telephone' => $request->nomor_telephone,
            'kelurahan_id' => $request->kelurahan,
            'is_active' => $is_active,
        ]);

        return redirect()->route('employee.index')->with('success','Berhasil Tambah Karyawan.');
    }

    public function edit(Customer $customer)
    {
        $customer = Customer::find($customer->id);
        $lokasi = Location::all();
        $profile = Setting::all();
        $paket = Paket::all();
        $kotas = Regency::where('province_id', '35')->get();
        $districts = District::all();
        $villages = Village::all();
        $order = Order::where('customer_id', $customer->id)->first();

        return view('backend.pages.customer.edit',
            compact('profile', 'customer', 'lokasi', 'paket', 'order', 'kotas', 'districts', 'villages')
        );
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nama_customer' => 'required',
            'nomor_telephone' => 'required|min:10|max:14',
            'nomor_layanan' => 'required|min:7|max:8'
        ]);

        if(!$validated){
            return redirect()->route('employee.index')->with('error','Property is not valid .');
        }

        $active = $request->input('is_active');
        if($active == 'ON' || $active == 'on'){
            $is_active = 1;
        }else{
            $is_active = 0;
        }

        $new = $request->input('is_new');
        if($new == 'ON' || $new == 'on'){
            $is_new = 1;
            $due_date = $request->input('due_date');
        }else{
            $is_new = 0;
            $due_date = $request->input('due_date');
        }

        $installed = $request->input('is_installed');
        if($installed == 'ON' || $installed == 'on'){
            $is_installed = 1;
        }else{
            $is_installed = 0;
        }

        $user = User::find($customer->user_id);
        $user->update([
            'name' => $request->nama_customer,
            'email' => $request->email,
        ]);

        $customer->update([
            'nama_customer' => $request->nama_customer,
            'nomor_layanan' =>$request->nomor_layanan,
            'nomor_ktp' => $request->nomor_ktp ?? 0,
            'gender' => $request->gender,
            'alamat_customer' => $request->alamat_customer,
            'kodepos_customer' => $request->kodepos_customer,
            'nomor_telephone' => $request->nomor_telephone,
            'kelurahan_id' => $request->kelurahan,
            'is_active' => $is_active,
            'is_new' => $is_new,
        ]);

        $order = Order::find($request->input('order_id'));

        $order->update([
            'customer_id' => $customer->id,
            'location_id' => $request->lokasi,
            'paket_id' => $request->paket_internet,
            'biaya_pasang' => $request->biaya_pasang,
            'installed_date' => $request->installed_date,
            'installed_status' => $is_installed,
            'order_date' => Date::now(),
            'due_date' => $due_date,
        ]);

        return redirect()->route('employee.index')->with('success','Berhasil Edit Karyawan.');
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
