<?php

namespace Andreracodex\Tripay;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\ShortURL;
use Illuminate\Support\Str;
use Illuminate\Http\Client\Request;
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

    public function transaction($tripay, $invoices, $amount)
    {
        $profile = Setting::all();
        $apiKey = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_API_SECRET');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $base = env('APP_URL');
        $baseURL = env('TRIPAY_API_DEBUG') ? 'https://tripay.co.id/api-sandbox/' : 'https://tripay.co.id/api/';
        $merchantRef  = $invoices;
        $amount       = $amount;

        $inv = OrderDetail::leftJoin('orders', 'order_details.order_id', 'orders.id')
            ->leftJoin('customers', 'orders.customer_id', 'customers.id')
            ->leftJoin('users', 'customers.user_id', 'users.id')
            ->leftJoin('pakets', 'orders.paket_id', 'pakets.id')
            ->where('order_details.invoice_number', $invoices)->first();

        $data = [
            'method'         => $tripay,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $inv->nama_customer,
            'customer_email' => $inv->email,
            'customer_phone' => $inv->nomor_telephone,
            'order_items'    => [
                [
                    'sku'         => $inv->nama_paket,
                    'name'        => $inv->jenis_paket,
                    'price'       => $amount,
                    'quantity'    => 1,
                ],
            ],
            'return_url'   => $baseURL . '/tripay/redirect',
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
        $data = json_decode($response, true)['data'];

        return view('tripay::result', compact('data', 'profile'));
    }

    public function callback()
    {
        return view('tripay::callback', compact('callback'));
    }

    public function short(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $shortURL = ShortURL::create([
            'original_url' => $request->url,
            'short_code' => Str::random(6), // Generate a random short code
        ]);

        return response()->json([
            'short_url' => route('short-url.redirect', $shortURL->short_code),
        ]);
    }

    public function redirect($code)
    {
        $shortURL = ShortURL::where('short_code', $code)->firstOrFail();

        return redirect($shortURL->original_url);
    }
}
