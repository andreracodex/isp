<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\InventarisKategori;
use App\Models\InventarisSatuan;
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

        if ($request->ajax()) {
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('inve_id', function (Inventaris $inve) {
                return $inve->id;
            })
            ->editColumn('location_id', function (Inventaris $inve) {
                return $inve->location->nama_location;
            })
            ->editColumn('jenis_id', function (Inventaris $inve) {
                return $inve->kategori->nama;
            })
            ->editColumn('jumlah_barang', function (Inventaris $inve) {
                return number_format($inve->jumlah_barang, 0, ',', '.');
            })
            ->editColumn('satuan_id', function (Inventaris $inve) {
                return $inve->satuan->nama;
            })
            ->addColumn('action', function (Inventaris $inve) {
                return "
                <a href=". route('inve.view', $inve->id) ." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('inve.edit', $inve->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusInven' data-id='$inve->id'><i class='fa fa-trash-alt'></i></button>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.inventaris.index', compact('profile'));
    }

    public function create()
    {
        $inve = new Inventaris;
        $kategories = InventarisKategori::where('is_active',1)->get();
        $satuan = InventarisSatuan::where('is_active',1)->get();
        $locations = Location::all();
        $profile = Setting::all();

        return view('backend.pages.inventaris.create',
            compact('profile', 'inve', 'locations', 'kategories', 'satuan')
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'location' => 'required',
            'nama_barang' => 'required|max:100',
            'jenis_id' => 'required',
            'jumlah_barang' => 'required',
            'satuan_id' => 'required',
            'is_active' => 'required',
        ]);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        Inventaris::create([
            'location_id' => $request->location,
            'nama_barang' => $request->nama_barang,
            'jenis_id' => $request->jenis_id,
            'jumlah_barang' => $request->jumlah_barang,
            'satuan_id' => $request->satuan_id,
            'is_active' => $is_active,
        ]);

        return redirect()->route('inve.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    public function view(Inventaris $inve)
    {
        $profile = Setting::all();
        $locations = Location::all();
        $kategories = InventarisKategori::where('is_active', 1)->get();
        $satuan = InventarisSatuan::where('is_active', 1)->get();

        return view('backend.pages.inventaris.view',
            compact('profile', 'inve', 'locations', 'kategories', 'satuan')
        );
    }

    public function edit(Inventaris $inve)
    {
        $profile = Setting::all();
        $locations = Location::all();
        $kategories = InventarisKategori::where('is_active', 1)->get();
        $satuan = InventarisSatuan::where('is_active', 1)->get();

        return view('backend.pages.inventaris.edit', compact('profile', 'inve', 'locations', 'kategories', 'satuan'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'location' => 'required',
            'nama_barang' => 'required|max:100',
            'jenis_id' => 'required',
            'jumlah_barang' => 'required',
            'satuan_id' => 'required',
            // 'is_active' => 'required',
        ]);

        $inve = Inventaris::findOrFail($id);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $inve->update([
            'location_id' => $request->location,
            'nama_barang' => $request->nama_barang,
            'jenis_id' => $request->jenis_id,
            'jumlah_barang' => $request->jumlah_barang,
            'satuan_id' => $request->satuan_id,
            'is_active' => $is_active,
        ]);

        return redirect()->route('inve.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function delete(string $id)
    {
        $inve = Inventaris::find($id);
        if($inve){
            Inventaris::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        }else{
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }
}
