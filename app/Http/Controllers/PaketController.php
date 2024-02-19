<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = Paket::orderBy('nama_paket', 'ASC')->get();
        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('paket_id', function (Paket $paket) {
                return $paket->id;
            })
            ->editColumn('nama_paket', function (Paket $paket) {
                return $paket->nama_paket;
            })
            ->editColumn('jenis_paket', function (Paket $paket) {
                return $paket->jenis_paket;
            })
            ->editColumn('harga_paket', function (Paket $paket) {
                return Number::currency($paket->harga_paket, in: 'IDR', locale: 'us');
            })
            ->addColumn('action', function (Paket $paket) {
                return "
                <a href=". route('paket.edit', $paket->id) ." class='btn btn-sm btn-warning d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
                <a href=". route('paket.edit', $paket->id) ." class='btn btn-sm btn-danger d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-trash-alt'></i></a>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.paket.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paket $paket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        //
    }
}
