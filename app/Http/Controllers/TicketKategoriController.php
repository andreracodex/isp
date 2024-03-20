<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketKategori;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TicketKategoriController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = TicketKategori::orderBy('nama', 'ASC')->get();

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('ticketcat_id', function (TicketKategori $ticketcat) {
                return $ticketcat->id;
            })
            ->editColumn('nama', function (TicketKategori $ticketcat) {
                return $ticketcat->nama;
            })
            ->addColumn('action', function (TicketKategori $ticketcat) {
                return "
                <a href=". route('ticketcat.edit', $ticketcat->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusTicketcat' data-id='$ticketcat->id'><i class='fa fa-trash-alt'></i></button>
                ";
            })
            ->make(true);
        }
        return view('backend.pages.ticketcategory.index', compact('profile'));
    }

    public function create()
    {
        $ticketcat = new TicketKategori;
        $profile = Setting::all();

        return view('backend.pages.ticketcategory.create', compact('profile', 'ticketcat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'is_active' => 'required',
        ]);

        $post = new TicketKategori();
        $post->nama = $request->input('nama');

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $post->is_active = 1;
        } else {
            $post->is_active = 0;
        }
        $post->save();

        return redirect()->route('ticketcat.index')->with('success','Berhasil Tambah Paket.');
    }

    public function edit(TicketKategori $ticketcat)
    {
        $profile = Setting::all();

        return view('backend.pages.ticketcategory.edit', compact('profile', 'ticketcat'));
    }

    public function update(Request $request, TicketKategori $ticketcat)
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

        $ticketcat = TicketKategori::find($ticketcat->id);
        $ticketcat->nama = $request->nama;
        $ticketcat->is_active = $is_active;
        $ticketcat->save();

        return redirect()->route('ticketcat.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function delete(String $id)
    {
        $ticketcat = TicketKategori::find($id);
        if ($ticketcat) {
            TicketKategori::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        } else {
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }
}
