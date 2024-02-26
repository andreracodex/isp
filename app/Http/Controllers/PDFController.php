<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function inventaris(Request $request) {
        $inve = Inventaris::all();
        $profile = Setting::all();
        $pdfContent = PDF::loadView('backend.pages.pdf.inventaris', compact('inve', 'profile'));
        return $pdfContent->download('inventaris.pdf');
    }
}
