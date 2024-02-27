<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;

class PaketController extends Controller
{
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
                <a href=". route('paket.edit', $paket->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusItem' data-id='$paket->id'><i class='fa fa-trash-alt'></i></button>
                ";
            })
            ->make(true);
        }
        return view('backend.pages.paket.index', compact('profile'));
    }

    public function create()
    {
        $paket = new Paket;
        $profile = Setting::all();
        return view('backend.pages.paket.create', compact('profile', 'paket'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_paket' => 'required',
            'jenis_paket' => 'required',
            'harga_paket' => 'required',
            'is_active' => 'required',
        ]);

        $post = new Paket();
        $post->nama_paket = $request->input('nama_paket');
        $post->jenis_paket = $request->input('jenis_paket');
        $post->harga_paket = $request->input('harga_paket');
        $post->disc = $request->input('disc');

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $post->is_active = 1;
        } else {
            $post->is_active = 0;
        }
        $post->save();
        $profile = Setting::all();

        return view('backend.pages.paket.index', compact('profile'));
    }

    public function show(Paket $paket)
    {
        //
    }

    public function edit(Paket $paket)
    {
        $profile = Setting::all();

        return view('backend.pages.paket.edit', compact('profile', 'paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $profile = Setting::all();
        $this->validate($request, [
            'nama_paket' => 'required',
            'jenis_paket' => 'required',
            'harga_paket' => 'required',
        ]);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $paket = Paket::find($paket->id);
        $paket->nama_paket = $request->nama_paket;
        $paket->jenis_paket = $request->jenis_paket;
        $paket->harga_paket = $request->harga_paket;
        $paket->is_active = $is_active;
        $paket->save();

        return view('backend.pages.paket.index', compact('profile'))->with(['success' => 'Data berhasil diubah!']);
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('paket.index')->with(['success' => 'Data berhasil dihapus!']);
    }
}
