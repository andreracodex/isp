<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Setting;
use Illuminate\Support\Number;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
        $profile = Setting::all();
        return view('backend.pages.customer.create', compact('profile', 'customer'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_customer' => 'required',
            'nomor_layanan' => 'required',
            'nomor_telephone' => 'required|min:10|max:14',
        ]);

        $post = new Customer();
        $post->nama_customer = $request->input('nama_customer');
        $post->gender = $request->input('gender');
        $post->nomor_layanan = $request->input('nomor_layanan');
        $post->alamat_customer = $request->input('alamat_customer');
        $post->kecamatan_customer = $request->input('kecamatan_customer');
        $post->desa_customer = $request->input('desa_customer');
        $post->kodepos_customer = $request->input('kodepos_customer');
        $post->nomor_telephone = $request->input('nomor_telephone');
        $active = $request->input('is_active');

        if($active == 'ON' || $active == 'on'){
            $post->is_active = 1;
        }else{
            $post->is_active = 0;
        }

        $post->save();
        $profile = Setting::all();
        return view('backend.pages.customer.index', compact('profile'));
    }

    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
        //
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
