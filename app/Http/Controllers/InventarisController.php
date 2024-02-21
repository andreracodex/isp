<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = Inventaris::orderBy('nama_barang', 'ASC')->get();
        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('inve_id', function (Inventaris $inve) {
                return $inve->id;
            })
            ->addColumn('action', function (Inventaris $inve) {
                return "
                <a href=".$inve->id." class='btn btn-sm btn-secondary d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('customer.edit', $inve->id) ." class='btn btn-sm btn-warning d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <a href=". route('customer.delete', $inve->id) ." class='btn btn-sm btn-danger d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete Data'><i class='fa fa-trash-alt'></i></a>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.inventaris.index', compact('profile'));
    }

    public function create(){
        $inve = new Inventaris;
        $profile = Setting::all();
        return view('backend.pages.inventaris.create', compact('profile', 'inve'));
    }

    public function store(Request $request){

    }
}
