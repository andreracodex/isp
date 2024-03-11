<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class PeriodeController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = Periode::orderBy('bulan_periode', 'DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('periode_id', function (Periode $periode) {
                return $periode->id;
            })
            ->addColumn('action', function (Periode $periode) {
                return "
                <a href=". route('periode.edit', $periode->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusPeriode' data-id='$periode->id'><i class='fa fa-trash-alt'></i></button>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.periode.index', compact('profile'));
    }

    public function create()
    {
        $periode = new Periode;
        $profile = Setting::all();

        return view('backend.pages.periode.create',
            compact('profile', 'periode')
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bulan_periode' => 'required',
            'is_active' => 'required',
        ]);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        Periode::create([
            'bulan_periode' => $request->bulan_periode,
            'is_active' => $is_active,
        ]);

        return redirect()->route('periode.index')->with(['success' => 'Periode berhasil disimpan!']);
    }

    public function edit(Periode $periode)
    {
        $profile = Setting::all();

        return view('backend.pages.periode.edit', compact('profile', 'periode'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'bulan_periode' => 'required',
            'is_active' => 'required',
        ]);

        $periode = Periode::findOrFail($id);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $periode->update([
            'bulan_periode' => $request->bulan_periode,
            'is_active' => $is_active,
        ]);

        return redirect()->route('periode.index')->with(['success' => 'Periode berhasil diubah!']);
    }

    public function delete(string $id)
    {
        $periode = Periode::find($id);

        if ($periode) {
            Periode::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Periode berhasil dihapus !']);
        } else {
            return redirect()->back()->with(['error' => 'Periode failed dihapus !']);
        }
    }
}
