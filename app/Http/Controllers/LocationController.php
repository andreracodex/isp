<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Setting;
use Illuminate\Support\Number;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = Location::orderBy('nama_locations', 'ASC')->get();
        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('location_id', function (Location $location) {
                return $location->id;
            })
            ->editColumn('nama_locations', function (Location $location) {
                return $location->nama_locations;
            })
            ->editColumn('alamat_locations', function (Location $location) {
                return $location->alamat_locations;
            })
            ->addColumn('action', function (Location $location) {
                return "
                <a href=". route('location.edit', $location->id) ." class='btn btn-sm btn-warning d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-pencil-alt'></i></a>
                <a href=". route('location.edit', $location->id) ." class='btn btn-sm btn-danger d-inline-flex' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-trash-alt'></i></a>
            ";
            })
            ->make(true);
        }
        return view('backend.pages.location.index', compact('profile'));
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
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
