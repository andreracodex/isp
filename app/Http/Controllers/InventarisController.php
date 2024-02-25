<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Location;
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
            ->editColumn('jumlah_barang', function (Inventaris $inve) {
                return number_format($inve->jumlah_barang, 0, ',', '.');
            })
            ->addColumn('action', function (Inventaris $inve) {
                return "
                <a href=".$inve->id." class='btn btn-sm btn-secondary d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('inve.edit', $inve->id) ." class='btn btn-sm btn-warning d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <a href=". route('inve.delete', $inve->id) ." class='btn btn-sm btn-danger d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete Data'><i class='fa fa-trash-alt'></i></a>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.inventaris.index', compact('profile'));
    }

    public function create()
    {
        $inve = new Inventaris;
        $locations = Location::all();
        $profile = Setting::all();

        return view('backend.pages.inventaris.create',
            compact('profile', 'inve', 'locations')
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'location' => 'required',
            'nama_barang' => 'required|max:100',
            'jenis_barang' => 'required',
            'jumlah_barang' => 'required',
            'satuan_barang' => 'required',
            'is_active' => 'required',
        ]);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $inve = Inventaris::create([
            'location_id' => $request->location,
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'satuan_barang' => $request->satuan_barang,
            'is_active' => $is_active,
        ]);

        return redirect()->route('inve.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    public function edit(Inventaris $inve)
    {
        $profile = Setting::all();
        $locations = Location::all();

        return view('backend.pages.inventaris.edit', compact('profile', 'inve', 'locations'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'location' => 'required',
            'nama_barang' => 'required|max:100',
            'jenis_barang' => 'required',
            'jumlah_barang' => 'required',
            'satuan_barang' => 'required',
            'is_active' => 'required',
        ]);

        $inve = Inventaris::findOrFail($id);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $inve = Inventaris::update([
            'location_id' => $request->location,
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'satuan_barang' => $request->satuan_barang,
            'is_active' => $is_active,
        ]);

        return redirect()->route('inve.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function destroy(string $id)
    {
        $inve = Inventaris::findOrFail($id);
        $inve->delete();

        return redirect()->route('inve.index')->with(['success' => 'Data berhasil dihapus!']);
    }
}
