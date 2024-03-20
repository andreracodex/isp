<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Inventaris;
use App\Models\InventarisKategori;
use App\Models\InventarisSatuan;
use App\Models\Paket;
use App\Models\Periode;
use App\Models\Location;
use App\Models\PaymentType;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Ticket;
use App\Models\TicketKategori;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function PDFInventaris(Request $request) {
        $inve = Inventaris::all();
        $profile = Setting::all();
        $pdfContent = PDF::loadView('backend.pages.pdf.inventaris', compact('inve', 'profile'));
        return $pdfContent->download('inventaris.pdf');
    }

    public function PDFTicketKategori(Request $request) {
        $ticketcat = TicketKategori::all();
        $profile = Setting::all();
        $pdfContent = PDF::loadView('backend.pages.pdf.ticketcat', compact('ticketcat', 'profile'));
        return $pdfContent->download('ticketcat.pdf');
    }
}
