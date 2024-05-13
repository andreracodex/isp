<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Setting;
use Illuminate\Http\Request;
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
        $messages = strip_tags($request->messages);
        try {
            if ($customers[0] == "0" || $customers[0] == 0) {
                $custom = Customer::where('is_active', '=', 1)->get();
                foreach ($custom as $cust) {
                    $phone  = Customer::where('id', '=', $cust->id)->first()->nomor_telephone;
                    $curl = curl_init();
                    $set = Setting::find(46);

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
                            'target' => convert_phone($phone),
                            'message' => $messages,
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
            } else {
                foreach ($customers as $customer) {
                    $phone  = Customer::where('id', '=', $customer)->first()->nomor_telephone;
                    $curl = curl_init();
                    $set = Setting::find(46);

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
                            'target' => convert_phone($phone),
                            'message' => $messages,
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
        } catch (\Exception $eror) {
            return redirect()->back()->with(['error' => 'Gagal Kirim WA Blast ' . $eror . '!']);
        }
    }
}
