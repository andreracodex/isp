<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function PDFInventaris(Request $request) {
        $inve = Inventaris::all();
        // must use
        $pdfContent = PDF::loadView('backend.pages.pdf.inventaris', array('inve' => $inve));
        return $pdfContent->download('inventaris.pdf');
    }
}