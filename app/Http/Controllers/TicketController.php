<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $profile = Setting::all();
        $ticket = Ticket::all();
        $ticket_active = Ticket::where('is_active', 1)->count();
        $data_table = Ticket::all();

        if ($request->ajax()){
            return DataTables::of($data_table)
            ->addIndexColumn()
            ->editColumn('ticket_id', function (Ticket $ticket) {
                return $ticket->id;
            })
            ->editColumn('nama_customer', function (Ticket $ticket) {
                return $ticket->customers->nama_customer;
            })
            ->editColumn('alamat_customer', function (Ticket $ticket) {
                return $ticket->customers->alamat_customer;
            })
            ->editColumn('nomor_telephone', function (Ticket $ticket) {
                return $ticket->customers->nomor_telephone;
            })
            ->addColumn('action', function (Ticket $ticket) {
                return "
                <a href=". route('ticket.view', $ticket->id) ." class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=". route('ticket.edit', $ticket->id) ." class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <a href=". route('ticket.delete', $ticket->id) ." class='avtar avtar-xs btn-link-danger btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete Data'><i class='fa fa-trash-alt'></i></a>
            ";
            })
            ->make(true);
        }

        return view('backend.pages.ticket.index', compact('ticket', 'ticket_active', 'profile'));
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
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
