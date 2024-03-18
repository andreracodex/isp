<?php

namespace Andreracodex\Tripay;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use config\tripay;
use Illuminate\Support\Facades\Http;

class TripayController extends Controller
{
    public function instruction($tripay)
    {
        $profile = Setting::all();
        $tripays = strtoupper($tripay);
        if ($tripays != 'MANDIRIVA' && $tripays != 'BCAVA' && $tripays != 'BRIVA' && $tripays != 'BNIVA' && $tripays != 'ALFAMART' && $tripays != 'ALFAMIDI' && $tripays != 'INDOMARET') {
            return view('tripay::failed', compact('profile'));
        }
        $apiKey = env('TRIPAY_API_KEY');
        $baseURL = env('TRIPAY_API_DEBUG') ? 'https://tripay.co.id/api-sandbox/' : 'https://tripay.co.id/api/';
        $payload = ['code' => $tripays];


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $baseURL . 'payment/instruction?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        if ($response) {
            $data = json_decode($response, true)['data'];
            return view('tripay::instruction', compact('data', 'profile'));
        }
    }

    public function merchant()
    {
        $profile = Setting::all();
        $apiKey = env('TRIPAY_API_KEY');
        $baseURL = env('TRIPAY_API_DEBUG') ? 'https://tripay.co.id/api-sandbox/' : 'https://tripay.co.id/api/';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $baseURL . 'merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($response) {
            $data = json_decode($response, true)['data'];

            return view('tripay::merchant', compact('data', 'profile'));
        }
    }

    public function transaction($invoices, $amount)
    {

        $apiKey = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_API_SECRET');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $baseURL = env('TRIPAY_API_DEBUG') ? 'https://tripay.co.id/api-sandbox/' : 'https://tripay.co.id/api/';
        $merchantRef  = $invoices;
        $amount       = $amount;

        $data = [
            'method'         => 'BRIVA',
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => 'Nama Pelanggan',
            'customer_email' => 'emailpelanggan@domain.com',
            'customer_phone' => '081234567890',
            'order_items'    => [
                [
                    'sku'         => 'FB-06',
                    'name'        => 'Paket Internet',
                    'price'       => $amount,
                    'quantity'    => 1,
                    'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                    'image_url'   => 'https://tokokamu.com/product/nama-produk-1.jpg',
                ],
            ],
            'return_url'   => 'https://billing.berdikari.web.id/redirect',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            =>  $baseURL . 'transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        echo empty($error) ? $response : $error;
    }

    public function callback()
    {
        return view('tripay::callback', compact('callback'));
    }
}
