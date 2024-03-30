<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Periode;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request){
        $profile = Setting::all();
        $customer = Customer::all();
        $date = Periode::where('is_active', 1)->get();
        $data_table = OrderDetail::select('orders.id as orderid',
        'orders.customer_id',
        'orders.location_id',
        'orders.paket_id',
        'orders.biaya_pasang',
        'orders.coordinates_id',
        'orders.path_ktp',
        'orders.path_image_rumah',
        'orders.installed_date',
        'orders.installed_image',
        'orders.installed_status',
        'order_details.id',
        'order_details.order_id',
        'order_details.uuid',
        'order_details.invoice_number',
        'order_details.payment_id',
        'order_details.pay_image',
        'order_details.pay_description',
        'order_details.diskon',
        'order_details.biaya_admin',
        'order_details.ppn',
        'order_details.due_date',
        'order_details.is_payed',
        'order_details.is_active'
        )
            ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->orderBy('order_details.created_at', 'DESC')
            ->get();

        // dd($data_table);
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

        if($request->input('status') == "null" || $request->input('status') == null){
            // Non Active
            $data_table = $data_table;
        }else{
            // All
            $status = $request->input('status');
            $data_table = $data_table->where('is_payed', '=', $status);
        }

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('order_id', function (OrderDetail $orderdetail) {
                return $orderdetail->id;
            })
            ->editColumn('nama_customer', function (OrderDetail $orderdetail) {
                return $orderdetail->order->customer->nama_customer;
            })
            ->editColumn('nomor_layanan', function (OrderDetail $orderdetail) {
                return $orderdetail->order->customer->nomor_layanan;
            })
            ->editColumn('alamat_customer', function (OrderDetail $orderdetail) {
                return $orderdetail->order->customer->alamat_customer;
            })
            ->editColumn('nomor_telephone', function (OrderDetail $orderdetail) {
                return $orderdetail->order->customer->nomor_telephone;
            })
            ->editColumn('nama_location', function (OrderDetail $orderdetail) {
                return $orderdetail->order->lokasi->nama_location;
            })
            ->editColumn('jenis_paket', function (OrderDetail $orderdetail) {
                return $orderdetail->order->paket->jenis_paket;
            })
            ->editColumn('due_date', function (OrderDetail $orderdetail) {
                return Carbon::parse($orderdetail->due_date)->format('d F Y');
            })
            ->editColumn('pay_status', function (OrderDetail $orderdetail) {
                return $orderdetail->is_payed;
            })
            ->editColumn('harga_paket', function (OrderDetail $orderdetail) {
                $formatted_price = Number::currency($orderdetail->order->paket->harga_paket, 'IDR', 'id');
                $formatted_price = str_replace(",00", "", $formatted_price);
                return $formatted_price;
            })
            ->addColumn('action', function (OrderDetail $orderdetail) {
                if($orderdetail->is_payed == 1){
                    return "
                    <a href=". route('order.view', $orderdetail->order_id)." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                    ";
                }else{
                    return "
                    <a href=". route('order.view', $orderdetail->order_id)." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                    <button class='avtar avtar-xs btn btn-link-warning btn-pc-default updatepayment' data-id='$orderdetail->id' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Payment Status'><i class='material-icons-two-tone'>attach_money</i> </button>
                    ";
                }
            })
            ->make(true);
            // <a href=". route('order.edit', $orderdetail->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
            //     <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusOrder' data-id='$orderdetail->id'><i class='fa fa-trash-alt'></i></button>
        }
        return view('backend.pages.order.index', compact('profile', 'customer', 'date'));
    }

    public function view(Order $order, Request $request)
    {
        $order = Order::find($order->id);
        $profile = Setting::all();
        $date = Periode::where('is_active', 1)->get();
        $data_table = OrderDetail::where('order_id', $order->id)->orderBy('created_at', 'ASC')->get();


        if ($request->input('tempo') != null && $request->input('tempo') != 0) {
            // Non Active
            $tempo = $request->input('tempo');
            $date = Periode::select('bulan_periode')->where('id', '=', $tempo)->first();
            $from = Carbon::parse($date->bulan_periode)->startOfMonth();
            $to = Carbon::parse($date->bulan_periode)->endOfMonth();
            $data_table = $data_table->whereBetween('due_date', [$from, $to]);
        } else {
            // All
            $data_table = $data_table;
        }

        if ($request->input('status') == "null" || $request->input('status') == null) {
            // All
            $data_table = $data_table;
        } else {
            // Status
            $status = $request->input('status');
            $data_table = $data_table->where('is_payed', '=', $status);


        }

        if ($request->ajax()) {
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('orderdetail_id', function (OrderDetail $orderdetail) {
                return $orderdetail->id;
            })
            ->editColumn('due_date', function (OrderDetail $orderdetail) {
                return Carbon::parse($orderdetail->due_date)->format('d F Y');
            })
            ->editColumn('pay_status', function (OrderDetail $orderdetail) {
                return $orderdetail->is_payed;
            })
            ->editColumn('harga_paket', function (OrderDetail $orderdetail) {
                $formatted_price = Number::currency($orderdetail->order->paket->harga_paket, 'IDR', 'id');
                $formatted_price = str_replace(",00", "", $formatted_price);
                return $formatted_price;
            })
            ->addColumn('action', function (OrderDetail $orderdetail) {
                if($orderdetail->is_payed == 1){
                    return "";
                }else{
                    return "
                    <button class='avtar avtar-xs btn btn-link-warning btn-pc-default updatestatus' data-id='$orderdetail->id' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Payment Status'><i class='material-icons-two-tone'>attach_money</i> </button>
                    ";
                }
                // <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusOrderDetail' data-id='$orderdetail->id'><i class='fa fa-trash-alt'></i></button>
            // <a href=". route('orderdetail.view', $orderdetail->id) ." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
            })
            ->make(true);
        }

        return view('backend.pages.order.view',
            compact('profile', 'order', 'date')
        );
    }

    public function edit(Order $order)
    {
        $order = Order::find($order->id);
        $orderdetail = OrderDetail::orderBy('created-at', 'ASC')->get();
        $profile = Setting::all();

        return view('backend.pages.order.edit',
            compact('profile', 'order', 'orderdetail')
        );
    }

    public function delete(String $id) {
        $order = Order::find($id);
        if ($order) {
            Order::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        } else {
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }

    public function execute(){
        $first = Carbon::now()->addMonth(1)->firstOfMonth()->format('Y-m-d');
        $last = Carbon::now()->addMonth(1)->lastOfMonth()->format('Y-m-d');

        $count = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
        ->whereBetween('due_date', [$first, $last])
        ->where('orders.customer_id', '=', 1)
        ->orderBy('order_id', 'DESC')
        ->groupBy('orders.customer_id', 'due_date', 'order_details.id')
        ->count();

        if($count != 0){
            return redirect()->route('order.index')->with('info', 'Tagihan Sudah Ada.');
        }else{
            Artisan::call('make:tagihan');
            return redirect()->route('order.index')->with('success', 'Tagihan Berhasil Dibuat.');
        }

    }
}


