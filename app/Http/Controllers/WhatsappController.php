<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Wa;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function index(){
        $profile = Setting::all();
        return view('backend.pages.wa.index', compact('profile'));
    }

    public function store(Request $request){
        $product = Wa::create($request->all());
    }
}
