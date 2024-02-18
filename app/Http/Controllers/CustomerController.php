<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Setting;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            // ->editColumn('harga', function (Customer $cust) {
            //     return $cust->paket->harga_paket;
            // })
            ->addColumn('action', function (Customer $cust) {
                return "
                <a href=". route('customer.edit', $cust->id) ." class='btn btn-sm btn-warning' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.customer.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = new Customer;
        $profile = Setting::all();
        return view('backend.pages.customer.create', compact('profile', 'customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
