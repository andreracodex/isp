<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request){
        $profile = Setting::all();
        $employee = Employee::all();
        $emp_active = Employee::where('is_active', 1)->count();
        $data_table = Employee::orderBy('nama_karyawan', 'ASC')->get();

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('emp_id', function (Employee $emp) {
                return $emp->id;
            })
            ->addColumn('action', function (Employee $emp) {
                return "
                <a href=". route('employee.view', $emp->id) ." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('employee.edit', $emp->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusEmp' data-id='$emp->id'><i class='fa fa-trash-alt'></i></button>
            ";
            })
            ->make(true);
        }

        return view('backend.pages.employee.index', compact('employee', 'emp_active', 'profile'));
    }

    public function create(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(String $id)
    {
        $emp = Employee::find($id);
        if($emp){
            Employee::where('id', $id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        }else{
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }

}
