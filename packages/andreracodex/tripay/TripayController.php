<?php

namespace Andreracodex\Tripay;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class TripayController extends Controller
{
    public function instruction($tripay)
    {
        $profile = Setting::all();
        $tripays = strtoupper($tripay);
        if($tripays != 'MANDIRIVA' && $tripays != 'BCAVA' && $tripays != 'BRIVA' && $tripays != 'BNIVA' && $tripays != 'ALFAMART' && $tripays != 'ALFAMIDI' && $tripays != 'INDOMARET'){
            return view('tripay::failed');
        }
        $apiKey = env('TRIPAY_API_KEY');
        $baseURL = env('TRIPAY_API_DEBUG') ? 'https://tripay.co.id/api-sandbox/' : 'https://tripay.co.id/api/';
        $payload = ['code' => $tripays];


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $baseURL. 'payment/instruction?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        if($response){
            $data = json_decode($response, true)['data'];
            return view('tripay::instruction', compact('data', 'profile'));
        }
    }

    public function callback(){
        return view('tripay::callback', compact('callback'));
    }
}
