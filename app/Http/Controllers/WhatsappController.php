<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Wa;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WhatsappController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = Wa::orderBy('device_name', 'ASC')->get();
        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('wa_id', function (Wa $wa) {
                return $wa->id;
            })
            ->editColumn('wa_paket', function (Wa $wa) {
                return $wa->paketwa->nama_paket;
            })
            ->addColumn('action', function (Wa $wa) {
                return "
                <a href='#' class='btn btn-sm btn-success d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Linked Device'><i class='fa fa-link'>&nbsp;</i></a>
                <a href='#' class='btn btn-sm btn-secondary d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Token'><i class='fa fa-lock'>&nbsp;</i></a>
                <a href=". route('wa.edit', $wa->id) ." class='btn btn-sm btn-warning d-inline-flex' type='button' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='tooltip on top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <a href=". route('wa.delete', $wa->id) ." class='btn btn-sm btn-danger d-inline-flex' type='button' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='tooltip on top' title='Delete Data'><i class='fa fa-trash-alt'></i></a>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.wa.index', compact('profile'));
    }

    public function create(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'device_name' => 'required',
                'device_number' => 'required|unique:wa|max:14',
            ]);

            $profile = Setting::all();
            $wa = new Wa();
            $wa->device_name = $request->device_name;
            $wa->device_number = $request->device_number;
            $wa->save();

            return view('backend.pages.wa.index', compact('profile'));

        } catch (Exception $c) {
            $profile = Setting::all();
            return view('backend.pages.wa.index', compact('profile'))->with('error', "Gagal, Create anothter number");
        }
    }
    public function store(Request $request)
    {

    }
}
