<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use App\Models\Setting;
use Illuminate\Support\Number;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = Location::orderBy('nama_location', 'ASC')->get();

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('location_id', function (Location $location) {
                return $location->id;
            })
            ->editColumn('nama_location', function (Location $location) {
                return $location->nama_location;
            })
            ->editColumn('alamat_location', function (Location $location) {
                return $location->alamat_location;
            })
            ->editColumn('employee_id', function (Location $location) {
                return $location->employee->nama_karyawan;
            })
            ->addColumn('action', function (Location $location) {
                return "
                <a href=". route('location.edit', $location->id) ." class='btn btn-sm btn-warning d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
                <a href=". route('location.delete', $location->id) ." class='btn btn-sm btn-danger d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-trash-alt'></i></a>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.location.index', compact('profile'));
    }

    public function create()
    {
        $location = new Location;
        $employees = Employee::all();
        $profile = Setting::all();

        return view('backend.pages.location.create',
            compact('profile', 'location', 'employees')
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'employee' => 'required',
            'nama_location' => 'required|max:50',
            'alamat_location' => 'required',
            'is_active' => 'required',
        ]);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $location = Location::create([
            'employee_id' => $request->employee,
            'nama_location' => $request->nama_location,
            'alamat_location' => $request->alamat_location,
            'is_active' => $is_active,
        ]);

        return redirect()->route('location.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    public function edit(Location $location)
    {
        $profile = Setting::all();
        $employees = Employee::all();

        return view('backend.pages.location.edit', compact('profile', 'location', 'employees'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'employee' => 'required',
            'nama_location' => 'required|max:50',
            'alamat_location' => 'required',
            'is_active' => 'required',
        ]);

        $location = Location::findOrFail($id);

        $active = $request->input('is_active');
        if ($active == 'ON' || $active == 'on') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $locationUpdate = Location::update([
            'employee_id' => $request->employee,
            'nama_location' => $request->nama_location,
            'alamat_location' => $request->alamat_location,
            'is_active' => $is_active,
        ]);

        return redirect()->route('location.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('location.index')->with(['success' => 'Data berhasil dihapus!']);
    }
}
