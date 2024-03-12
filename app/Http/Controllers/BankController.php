<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\PaymentType;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = Bank::orderBy('nama_bank', 'ASC')->get();

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('bank_id', function (Bank $bank) {
                return $bank->id;
            })
            ->editColumn('payment', function (Bank $bank) {
                return $bank->paymentType->payment_methode_name;
            })
            ->addColumn('action', function (Bank $bank) {
                return "
                <a href=". route('bank.edit', $bank->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusBank' data-id='$bank->id'><i class='fa fa-trash-alt'></i></button>
                ";
            })
            ->make(true);
        }
        return view('backend.pages.bank.index', compact('profile'));
    }

    public function create()
    {
        $bank = new Bank;
        $profile = Setting::all();

        return view('backend.pages.bank.create', compact('profile', 'bank'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'kode_bank' => 'required',
            'nama_bank' => 'required',
            'nama_akun' => 'required',
            'nomor_akun_rekening' => 'required',
            'payment' => 'required',
            'is_active' => 'required',
        ]);

        $post = new Bank();
        $post->kode_bank = $request->input('kode_bank');
        $post->nama_bank = $request->input('nama_bank');
        $post->nama_akun = $request->input('nama_akun');
        $post->nomor_akun_rekening = $request->input('nomor_akun_rekening');
        $post->payment_id = $request->input('payment');

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $post->is_active = 1;
        } else {
            $post->is_active = 0;
        }
        $post->save();
        $profile = Setting::all();

        return redirect()->route('bank.index')->with(['success' => 'Bank berhasil disimpan!']);
    }

    public function edit(Bank $bank)
    {
        $profile = Setting::all();

        return view('backend.pages.bank.edit', compact('profile', 'bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $profile = Setting::all();

        $this->validate($request, [
            'kode_bank' => 'required',
            'nama_bank' => 'required',
            'nama_akun' => 'required',
            'nomor_akun_rekening' => 'required',
            'payment' => 'required',
            'is_active' => 'required',
        ]);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $bank = Bank::find($bank->id);
        $bank->kode_bank = $request->input('kode_bank');
        $bank->nama_bank = $request->input('nama_bank');
        $bank->nama_akun = $request->input('nama_akun');
        $bank->nomor_akun_rekening = $request->input('nomor_akun_rekening');
        $bank->payment_id = $request->input('payment');
        $bank->is_active = $is_active;
        $bank->save();

        return redirect()->route('bank.index')->with(['success' => 'Bank berhasil diubah!']);
    }

    public function delete(string $id)
    {
        $bank = Bank::find($id);
        if ($bank) {
            Bank::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Bank berhasil dihapus !']);
        } else {
            return redirect()->back()->with(['error' => 'Bank gagal dihapus !']);
        }
    }
}
