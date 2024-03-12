<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class PaymentTypeController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = PaymentType::orderBy('payment_methode_name', 'ASC')->get();

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('paymenttype_id', function (PaymentType $paymenttype) {
                return $paymenttype->id;
            })
            ->editColumn('payment_methode_name', function (PaymentType $paymenttype) {
                return $paymenttype->payment_methode_name;
            })
            ->addColumn('action', function (PaymentType $paymenttype) {
                return "
                <a href=". route('paymenttype.edit', $paymenttype->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusPaymentType' data-id='$paymenttype->id'><i class='fa fa-trash-alt'></i></button>
                ";
            })
            ->make(true);
        }
        return view('backend.pages.paymenttype.index', compact('profile'));
    }

    public function create()
    {
        $paymenttype = new PaymentType;
        $profile = Setting::all();

        return view('backend.pages.paymenttype.create', compact('profile', 'paymenttype'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'payment_methode_name' => 'required',
            'is_active' => 'required',
        ]);

        $post = new PaymentType();
        $post->payment_methode_name = $request->input('payment_methode_name');

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $post->is_active = 1;
        } else {
            $post->is_active = 0;
        }
        $post->save();
        $profile = Setting::all();

        return view('backend.pages.paymenttype.index', compact('profile'));
    }

    public function edit(PaymentType $paymenttype)
    {
        $profile = Setting::all();

        return view('backend.pages.paymenttype.edit', compact('profile', 'paymenttype'));
    }

    public function update(Request $request, PaymentType $paymenttype)
    {
        $profile = Setting::all();

        $this->validate($request, [
            'payment_methode_name' => 'required',
        ]);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $paymenttype = PaymentType::find($paymenttype->id);
        $paymenttype->payment_methode_name = $request->payment_methode_name;
        $paymenttype->is_active = $is_active;
        $paymenttype->save();

        return redirect()->route('paymenttype.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function delete(string $id)
    {
        $paymenttype = PaymentType::find($id);
        if ($paymenttype) {
            PaymentType::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        } else {
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }
}
