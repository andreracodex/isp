<?php

namespace App\Http\Controllers;

use App\Models\InventarisKategori;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class InventarisKategoriController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = InventarisKategori::orderBy('nama', 'ASC')->get();

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('invekategori_id', function (InventarisKategori $invekategori) {
                return $invekategori->id;
            })
            ->editColumn('nama', function (InventarisKategori $invekategori) {
                return $invekategori->nama;
            })
            ->addColumn('action', function (InventarisKategori $invekategori) {
                return "
                <a href=". route('invekategori.edit', $invekategori->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusKateinven' data-id='$invekategori->id'><i class='fa fa-trash-alt'></i></button>
                ";
            })
            ->make(true);
        }
        return view('backend.pages.inventaris_kategori.index', compact('profile'));
    }

    public function create()
    {
        $invekategori = new InventarisKategori;
        $profile = Setting::all();

        return view('backend.pages.inventaris_kategori.create', compact('profile', 'invekategori'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama' => 'required',
            'is_active' => 'required',
        ]);

        $post = new InventarisKategori();
        $post->nama = $request->input('nama');

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $post->is_active = 1;
        } else {
            $post->is_active = 0;
        }
        $post->save();
        $profile = Setting::all();

        return view('backend.pages.inventaris_kategori.index', compact('profile'));
    }

    public function edit(InventarisKategori $invekategori)
    {
        $profile = Setting::all();

        return view('backend.pages.inventaris_kategori.edit', compact('profile', 'invekategori'));
    }

    public function update(Request $request, InventarisKategori $invekategori)
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

        $invekategori = InventarisKategori::find($invekategori->id);
        $invekategori->nama = $request->nama;
        $invekategori->is_active = $is_active;
        $invekategori->save();

        return redirect()->route('invekategori.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function delete(String $id)
    {
        $invenkategori = InventarisKategori::find($id);
        if($invenkategori){
            InventarisKategori::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        }else{
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }
}
