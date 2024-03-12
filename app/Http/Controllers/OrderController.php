<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Periode;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request){
        $profile = Setting::all();
        $customer = Customer::all();
        $date = Periode::where('is_active', 1)->get();
        $data_table = Order::leftJoin('order_details', 'order_details.order_id','=', 'orders.id')->orderBy('orders.customer_id', 'ASC')->get();

        if($request->input('customerid') != null && $request->input('customerid') != 0){
            // Non Active
            $customer_id = $request->input('customerid');
            $data_table = $data_table->where('customer_id', '=', $customer_id);
        }else{
            // All
            $data_table = $data_table;
        }

        if($request->input('tempo') != null && $request->input('tempo') != 0){
            // Non Active
            $tempo = $request->input('tempo');
            $date = Periode::select('bulan_periode')->where('id', '=', $tempo)->first();
            $from = Carbon::parse($date->bulan_periode)->startOfMonth();
            $to = Carbon::parse($date->bulan_periode)->endOfMonth();
            $data_table = $data_table->whereBetween('due_date', [$from, $to]);
        }else{
            // All
            $data_table = $data_table;
        }

        if($request->input('status') != null){
            // Non Active
            $status = $request->input('status');
            $data_table = $data_table->where('orderdetail.pay_status', '=', $status);
        }else{
            // All
            $data_table = $data_table;
        }

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('order_id', function (Order $order) {
                return $order->id;
            })
            ->editColumn('nama_customer', function (Order $order) {
                return $order->customer->nama_customer;
            })
            ->editColumn('nomor_layanan', function (Order $order) {
                return $order->customer->nomor_layanan;
            })
            ->editColumn('alamat_customer', function (Order $order) {
                return $order->customer->alamat_customer;
            })
            ->editColumn('nomor_telephone', function (Order $order) {
                return $order->customer->nomor_telephone;
            })
            ->editColumn('nama_location', function (Order $order) {
                return $order->lokasi->nama_location;
            })
            ->editColumn('jenis_paket', function (Order $order) {
                return $order->paket->jenis_paket;
            })
            ->editColumn('due_date', function (Order $order) {
                return Carbon::parse($order->due_date)->format('d F Y');
            })
            ->editColumn('pay_status', function (Order $order) {
                return $order->orderdetail->pay_status;
            })
            ->editColumn('harga_paket', function (Order $order) {
                $formatted_price = Number::currency($order->paket->harga_paket, 'IDR', 'id');
                $formatted_price = str_replace(",00", "", $formatted_price);
                return $formatted_price;
            })
            ->addColumn('action', function (Order $order) {
                return "
                <a href=". route('order.view', $order->id)." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('order.edit', $order->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusOrder' data-id='$order->id'><i class='fa fa-trash-alt'></i></button>
                ";
            })
            ->make(true);
        }
        return view('backend.pages.order.index', compact('profile', 'customer', 'date'));
    }


    public function delete(String $id){
        $order = Order::find($id);
        if($order){
            Order::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        }else{
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }
}


