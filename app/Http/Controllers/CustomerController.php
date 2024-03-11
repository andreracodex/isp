<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Location;
use App\Models\Order;
use App\Models\Paket;
use App\Models\Regency;
use App\Models\District;
use App\Models\Setting;
use App\Models\User;
use App\Models\Village;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = Customer::orderBy('nama_customer', 'ASC')->get();
        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('cust_id', function (Customer $cust) {
                return $cust->id;
            })
            ->addColumn('action', function (Customer $cust) {
                return "
                <a href=".$cust->id." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('customer.edit', $cust->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusCust' data-id='$cust->id'><i class='fa fa-trash-alt'></i></button>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.customer.index', compact('profile'));
    }

    public function create()
    {
        $customer = new Customer;
        $lokasi = Location::all();
        $profile = Setting::all();
        $paket = Paket::all();
        $kotas = Regency::where('province_id', '35')->orderBy('name', 'ASC')->get();
        $districts = Regency::where('province_id')->get();
        $villages = Regency::where('province_id')->get();
        $order = new Order;
        return view('backend.pages.customer.create',
            compact('profile', 'customer', 'lokasi', 'paket', 'order', 'kotas', 'districts', 'villages')
        );
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_customer' => 'required',
            'nomor_telephone' => 'required|min:10|max:14',
            'email' => 'required|email:dns|unique:users',
        ]);

        if(!$validated){
            return redirect()->route('customer.index')->with('error','Property is not valid .');
        }

        $user = User::create([
            'name' => $request->nama_customer,
            'user_name' => $request->nama_customer,
            'email' => $request->email,
            'password' => bcrypt('12345678'),
        ]);

        $active = $request->input('is_active');
        if($active == 'ON' || $active == 'on'){
            $is_active = 1;
        }else{
            $is_active = 0;
        }

        $new = $request->input('is_new');
        if($new == 'ON' || $new == 'on'){
            $is_new = 1;
            $due_date = Carbon::parse($request->input('due_date'))->addMonths(1);
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

        $customer = Customer::create([
            'user_id' => $user->id,
            'nama_customer' => $request->nama_customer,
            'nomor_layanan' => mt_rand(10000000 ,99999999),
            'nomor_ktp' => $request->nomor_ktp ?? 0,
            'gender' => $request->gender,
            'alamat_customer' => $request->alamat_customer,
            'kodepos_customer' => $request->kodepos_customer,
            'nomor_telephone' => $request->nomor_telephone,
            'kelurahan_id' => $request->kelurahan,
            'is_active' => $is_active,
            'is_new' => $is_new,
        ]);

        Order::create([
            'customer_id' => $customer->id,
            'location_id' => $request->lokasi,
            'paket_id' => $request->paket_internet,
            'biaya_pasang' => $request->biaya_pasang,
            'installed_date' => $request->installed_date,
            'installed_status' => $is_installed,
            'order_date' => Date::now(),
            'due_date' => $due_date,
        ]);

        return redirect()->route('customer.index')->with('success','Berhasil Tambah Customer.');
    }

    public function show(Customer $customer)
    {
        //
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
            return redirect()->route('customer.index')->with('error','Property is not valid .');
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

        return redirect()->route('customer.index')->with('success','Berhasil Edit Customer.');
    }

    public function delete(String $id)
    {
        $cust = Customer::find($id);
        if($cust){
            Customer::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        }else{
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }
}
