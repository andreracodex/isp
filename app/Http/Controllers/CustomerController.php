<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Location;
use App\Models\Order;
use App\Models\Paket;
use App\Models\Regency;
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
                <a href=". route('customer.delete', $cust->id) ." class='avtar avtar-xs btn-link-danger btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete Data'><i class='fa fa-trash-alt'></i></a>
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
        $kotas = Regency::where('province_id', '35')->get();
        $order = new Order;
        return view('backend.pages.customer.create',
            compact('profile', 'customer', 'lokasi', 'paket', 'order', 'kotas')
        );
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_customer' => 'required',
            'nomor_telephone' => 'required|min:10|max:14',
            'nomor_ktp' => 'required|min:16|max:20',
        ]);

        $user = User::create([
            'name' => $request->nama_customer,
            'user_name' => $request->nama_customer,
            'email' => $request->kodepos_customer,
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

        $customer = Customer::create([
            'user_id' => $user->id,
            'nama_customer' => $request->nama_customer,
            'nomor_layanan' => 'GDN-' . mt_rand(111111 ,999999),
            'nomor_ktp' => $request->nomor_ktp,
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
            'biaya_pasang' => $request->biaya_pasang,
            'paket_id' => $request->paket_internet,
            'installed_date' => $request->installed_date,
            'order_date' => Date::now(),
            'due_date' => $request->due_date,
            'location_id' => $request->lokasi,
        ]);

        return redirect()->route('customer.index')->with('success','Property is updated .');
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
        $order = Order::where('customer_id', $customer->id)->first();
        return view('backend.pages.customer.edit', compact('profile', 'customer', 'lokasi', 'paket', 'order', 'kotas'));
    }

    public function update(Request $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
