<?php

namespace App\Http\Controllers;

use App\Models\InventarisSatuan;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class InventarisSatuanController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = InventarisSatuan::orderBy('nama', 'ASC')->get();

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('invekategori_id', function (InventarisSatuan $invekategori) {
                return $invekategori->id;
            })
            ->editColumn('nama', function (InventarisSatuan $invekategori) {
                return $invekategori->nama;
            })
            ->addColumn('action', function (InventarisSatuan $invekategori) {
                return "
                <a href=". route('invekategori.edit', $invekategori->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusItem' data-id='$invekategori->id'><i class='fa fa-trash-alt'></i></button>
                ";
            })
            ->make(true);
        }
        return view('backend.pages.inventaris_satuan.index', compact('profile'));
    }

    public function create()
    {
        $invekategori = new InventarisSatuan;
        $profile = Setting::all();

        return view('backend.pages.inventaris_satuan.create', compact('profile', 'invekategori'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama' => 'required',
            'is_active' => 'required',
        ]);

        $post = new InventarisSatuan();
        $post->nama = $request->input('nama');

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $post->is_active = 1;
        } else {
            $post->is_active = 0;
        }
        $post->save();
        $profile = Setting::all();

        return view('backend.pages.inventaris_satuan.index', compact('profile'));
    }

    public function edit(InventarisSatuan $invesatuan)
    {
        $profile = Setting::all();

        return view('backend.pages.inventaris_satuan.edit', compact('profile', 'invesatuan'));
    }

    public function update(Request $request, InventarisSatuan $invesatuan)
    {
        $profile = Setting::all();

        $this->validate($request, [
            'nama' => 'required',
        ]);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $invesatuan = InventarisSatuan::find($invesatuan->id);
        $invesatuan->nama = $request->nama;
        $invesatuan->is_active = $is_active;
        $invesatuan->save();

        return view('backend.pages.inventaris_kategori.index', compact('profile'))->with(['success' => 'Data berhasil diubah!']);
    }

    public function destroy(InventarisSatuan $invesatuan)
    {
        $invesatuan->delete();
        return redirect()->route('invesatuan.index')->with(['success' => 'Data berhasil dihapus!']);
    }
}
