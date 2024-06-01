<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

use function App\Http\Helpers\convert_phone;

class BlastController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $customers = Customer::all();
        return view('backend.pages.message.create', compact('profile', 'customers'));
    }

    public function store(Request $request)
    {

        $customers = $request->customer;
        $messages = $request->messages;

        // Replace <p> tags with newlines
        $converted = preg_replace('/<p[^>]*>/', '', $messages);
        $converted = preg_replace('/<\/p>/', "\n\n", $converted);

        // Remove <strong> tags
        $converted = preg_replace('/<strong[^>]*>/', "*", $converted);
        $converted = preg_replace('/<\/strong>/', "*", $converted);

        // Remove <i> tags
        $converted = preg_replace('/<i[^>]*>/', "_", $converted);
        $converted = preg_replace('/<\/i>/', "_", $converted);

        // Remove <br> tags
        $converted = preg_replace('/<br[^>]*>/', "\n", $converted);
        $converted = preg_replace('/&nbsp;/', '', $converted);

        if ($customers[0] == "0") {
            $custom = Customer::where('is_active', '=', 1)->get();
            $now = Carbon::now()->format('Y-m-d');

            try{
                foreach ($custom as $cust) {
                    $curl = curl_init();
                    $set = Setting::find(46);
                    $converted = preg_replace('/%customer%/', $cust->nama_customer, $converted);
                    $converted = preg_replace('/%bulantahun%/', Carbon::parse($now)->format('F Y'), $converted);

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.fonnte.com/send',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'target' => convert_phone($cust->nomor_telephone),
                            'message' => $converted,
                            'countryCode' => '62', //optional
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: ' . $set->value //change TOKEN to your actual token
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                }
            }catch (\Exception $eror){
                return back()->with('erorrs','Erors Found'.$eror.'');
            }

        } else {
            $now = Carbon::now()->format('Y-m-d');
            foreach ($customers as $customer) {
                $phone  = Customer::where('id', '=', $customer)->first();
                $curl = curl_init();
                $set = Setting::find(46);
                $converted = preg_replace('/%customer%/', $phone->nama_customer, $converted);
                $converted = preg_replace('/%bulantahun%/', Carbon::parse($now)->format('F Y'), $converted);

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'target' => convert_phone($phone->nomor_telephone),
                        'message' => $converted,
                        'countryCode' => '62', //optional
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . $set->value //change TOKEN to your actual token
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
            }

            return redirect()->route('blast.index')->with('success', 'Pesan Berhasil Dibuat.');
        }
    }
}
