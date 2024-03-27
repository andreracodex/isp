<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class IndoRegionController extends Controller
{
    public function kota(Request $request) {
        // $id_provinsi = $request->id_provinsi;
        $kotas = Regency::where('province_id', 35)->get();

        // $option = "<option>Pilih kota...</option>";
        // echo $option;

        foreach($kotas as $kota) {
            echo "<option value='$kota->id'>$kota->name</option>";
        }
    }

    public function kecamatan(Request $request) {
        $id_kota = $request->id_kota;
        $kecamatans = District::where('regency_id', $id_kota)->get();

        // $option = "<option>Pilih kecamatan...</option>";
        // echo $option;

        foreach($kecamatans as $kecamatan) {
            echo "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }
    }

    public function kelurahan(Request $request) {
        $id_kecamatan = $request->id_kecamatan;
        $kelurahans = Village::where('district_id', $id_kecamatan)->get();

        // $option = "<option>Pilih kelurahan...</option>";
        // echo $option;

        foreach($kelurahans as $kelurahan) {
            echo "<option value='$kelurahan->id'>$kelurahan->name</option>";
        }
    }
}
