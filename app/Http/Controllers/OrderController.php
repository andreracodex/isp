<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request){
        $profile = Setting::all();
        $data_table = Order::orderBy('customer_id', 'ASC')->get();
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
            ->editColumn('harga_paket', function (Order $order) {
                return Number::currency($order->paket->harga_paket, in: 'IDR', locale: 'us');
            })
            ->addColumn('action', function (Order $order) {
                return "
                <a href=". route('order.view', $order->id)." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('order.edit', $order->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <a href=". route('order.delete', $order->id) ." class='avtar avtar-xs btn-link-danger btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete Data'><i class='fa fa-trash-alt'></i></a>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.order.index', compact('profile'));
    }
}
