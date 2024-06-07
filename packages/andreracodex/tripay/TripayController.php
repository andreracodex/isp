<?php

namespace Andreracodex\Tripay;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\SettingsWA;
use App\Models\ShortURL;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Number;
use Psy\Readline\Transient;

use function App\Http\Helpers\convert_phone;

class TripayController extends Controller
{
    public function instruction($tripay, $paycode)
    {
        try {
            $validChannels = [
                'MYBVA', 'PERMATAVA', 'BNIVA', 'BRIVA', 'MANDIRIVA', 'BCAVA', 'MUAMALATVA',
                'CIMBVA', 'BSIVA', 'OCBCVA', 'DANAMONVA', 'OTHERBANKVA', 'ALFAMART',
                'INDOMARET', 'ALFAMIDI', 'OVO', 'QRIS', 'QRISC', 'QRIS2', 'DANA', 'SHOPEEPAY',
                'QRIS_SHOPEEPAY'
            ];

            $profile = Setting::all();
            $tripays = strtoupper($tripay);

            if (!in_array($tripays, $validChannels)) {
                return view('tripay::failed', compact('profile'));
            }

            $apiKey = Setting::find(47);
            $tripaySandBox = Setting::find(49);
            $tripayUrl = $tripaySandBox->value == 'on'
                ? "https://tripay.co.id/api-sandbox/"
                : "https://tripay.co.id/api/";

            $payload = ['code' => $tripays, 'pay_code' => $paycode];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => $tripayUrl . 'payment/instruction?' . http_build_query($payload),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey->value],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            if ($response) {
                $data = json_decode($response, true)['data'];
                return view('tripay::instruction', compact('data', 'profile'));
            } else {
                // Log the error for debugging purposes
                Log::error('Tripay API request failed', ['error' => $error]);
                abort(404, 'Unable to fetch data from Tripay API');
            }
        } catch (Exception $error) {
            // Log the exception for debugging purposes
            Log::error('Exception occurred', ['exception' => $error]);
            abort(404, 'An error occurred');
        }
    }

    public function showmerchant()
    {
        try {
            $profile = Setting::all();
            $apiKey = Setting::find(47);
            $tripaySandBox = Setting::find(49);

            $tripayUrl = $tripaySandBox->value == 'on'
                ? "https://tripay.co.id/api-sandbox/"
                : "https://tripay.co.id/api/";

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => $tripayUrl . 'merchant/payment-channel',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey->value],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            if ($response) {
                $data = json_decode($response, true)['data'];

                return view('tripay::merchant', compact('data', 'profile'));
            } else {
                // Log the error for debugging purposes
                Log::error('Tripay API request failed', ['error' => $error]);
                abort(404, 'Unable to fetch data from Tripay API');
            }
        } catch (Exception $error) {
            // Log the exception for debugging purposes
            Log::error('Exception occurred', ['exception' => $error]);
            abort(404, 'An error occurred');
        }
    }

    public function failed($errors){
        $profile = Setting::all();
        return view('tripay::failed', compact('profile', 'errors'));
    }

    public function great($great){
        $profile = Setting::all();
        return view('tripay::great', compact('profile', 'great'));
    }

    public function transaction($tripay, $invoices, $amount)
    {
        $profile = Setting::all();
        $apiKey = Setting::find(47);
        $privateKey   = Setting::find(48);
        $merchantCode = Setting::find(50);
        $tripaySandBox = Setting::find(49);
        $tripayUrl = $tripaySandBox->value == 'on'
        ? "https://tripay.co.id/api-sandbox/"
        : "https://tripay.co.id/api/";

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
            'callback_url' => $tripayUrl . 'tripay/callback',
            'return_url'   => $tripayUrl . 'tripay/redirect',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode->value . $merchantRef . $amount, $privateKey->value)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            =>  $tripayUrl . 'transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey->value],
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

    public function handle(Request $request)
    {
        $privateKey   = Setting::find(48);
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        // $res = json_decode($json);
        // $signature = hash_hmac('sha256', $res->reference . $res->merchant_ref . $res->total_amount, $privateKey->value);
        $signature = hash_hmac('sha256', $json, $privateKey);

        if ($signature !== (string) $callbackSignature) {
            return response()->json([
                'success' => false,
                'signature' => $signature,
                'callback' => $callbackSignature,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return response()->json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $invoiceId = $data->merchant_ref;
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {

            $details = OrderDetail::where('reference', $tripayReference)
                ->where('is_payed', 0)
                ->first();

            $invoice = Transaction::where('reference', $tripayReference)
                ->where('status', '=', 'UNPAID')
                ->first();

            if (! $invoice) {
                return response()->json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $invoiceId,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $invoice->update(['status' => 'PAID']);
                    $details->update(['is_payed' => 1]);

                    $set = Setting::find(46);
                    $was = SettingsWA::find(7);

                    if ($was->is_active == 1) {
                        $message = Setting::find(52);
                        $metode_bayar = 'Tripay Merchant';
                        // Replace <p> tags with newlines
                        $converted = preg_replace('/<p[^>]*>/', '', $message->value);
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

                        $converted = preg_replace('/%customer%/', $invoice->customer_name, $converted);
                        $converted = preg_replace('/%invoices%/', $invoice->merchant_ref, $converted);
                        $converted = preg_replace('/%bulantahun%/', Carbon::parse($details->due_date)->format('F Y'), $converted);
                        $converted = preg_replace('/%metode_bayar%/', $metode_bayar, $converted);
                        $converted = preg_replace('/%tanggalbayar%/', Carbon::now()->format('d F Y'), $converted);

                        // Nama Perusahaan dan Keterangan Lainnya
                        $aliasperusahaan = Setting::find(6);
                        $namaperusahaan = Setting::find(23);
                        $val1 = Setting::find(24);
                        $val2 = Setting::find(25);
                        $val3 = Setting::find(26);
                        $val4 = Setting::find(27);
                        $alamatperusahaan = ($val1->value.', '.$val2->value.', '.$val3->value.' - '.$val4->value);
                        $phone = Setting::find(29);
                        $phonealternate = Setting::find(19);
                        $urlperusahaan = Setting::find(20);

                        $converted = preg_replace('/%aliasperusahaan%/', $aliasperusahaan->value, $converted);
                        $converted = preg_replace('/%namaperusahaan%/', $namaperusahaan->value, $converted);
                        $converted = preg_replace('/%alamatperusahaan%/', $alamatperusahaan, $converted);
                        $converted = preg_replace('/%phone%/', $phone->value , $converted);
                        $converted = preg_replace('/%phonealternate%/', $phonealternate->value, $converted);
                        $converted = preg_replace('/%urlperusahaan%/', $urlperusahaan->value, $converted);

                        $curl = curl_init();

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
                                'target' => convert_phone($invoice->customer_phone),
                                'message' => $converted,
                                'countryCode' => '62', //optional
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'Authorization: ' . $set->value //change TOKEN to your actual token
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);
                    };

                    break;

                case 'EXPIRED':
                    $invoice->update(['status' => 'EXPIRED']);
                    $details->update(['is_payed' => 0]);
                    break;

                case 'FAILED':
                    $invoice->update(['status' => 'FAILED']);
                    $details->update(['is_payed' => 0]);
                    break;

                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return response()->json(['success' => true]);
        }
    }

    public function merchantstore(Request $request){
        try{
            $invoices = $request->input('invoice_number');
            $tripay = $request->input('code');

            $detail = OrderDetail::leftJoin('orders', 'order_details.order_id', 'orders.id')
                ->leftJoin('pakets', 'orders.paket_id', 'pakets.id')
                ->where('order_details.invoice_number', $invoices)->first();

            if($detail == null){
                $errors = "Invoice Number Not Found";
                return redirect()->route('tripay.failed', $errors);
            }

            if($detail->is_payed == 1){
                $errors = "Invoice Already Payed";
                return redirect()->route('tripay.great', $errors);
            }

            $amount = intval($detail->harga_paket);

            $profile = Setting::all();
            $apiKey = Setting::find(47);
            $privateKey   = Setting::find(48);
            $merchantCode = Setting::find(50);
            $tripay_sand_box = Setting::find(49);
            if($tripay_sand_box->value == 'on'){
                $tripay_url = "https://tripay.co.id/api-sandbox/";
            }else{
                $tripay_url = "https://tripay.co.id/api/";
            }

            $merchantRef  = $invoices;

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
                'callback_url'   => $tripay_url . 'tripay/callback',
                'return_url'   => $tripay_url . 'tripay/redirect',
                'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                'signature'    => hash_hmac('sha256', $merchantCode->value . $merchantRef . $amount, $privateKey->value)
            ];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            =>  $tripay_url . 'transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey->value],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data),
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            $data = json_decode($response, true)['data'];

            $inv->reference = $data['reference'];
            $inv->fee_customer = $data['fee_customer'];
            $inv->fee_merchant = $data['fee_merchant'];
            $inv->save();
            // Kirim WA
            $set = Setting::find(46);
            $message = Setting::find(54);
                        // Replace <p> tags with newlines
            $converted = preg_replace('/<p[^>]*>/', '', $message->value);
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

            $url_cara_bayar = route('tripay.instruction', [$data['payment_method'], $data['pay_code']]);
            $converted = preg_replace('/%customer%/', $data['customer_name'], $converted);
            $converted = preg_replace('/%merchantcode%/', $data['reference'], $converted);
            $converted = preg_replace('/%provider%/', $data['payment_name'], $converted);
            $converted = preg_replace('/%virtualnumber%/', $data['pay_code'], $converted);
            $converted = preg_replace('/%harga%/', 'Rp ' . number_format($data['amount_received'], 0, ',', '.'), $converted);
            $converted = preg_replace('/%customerfee%/', 'Rp ' . number_format($data['fee_customer'], 0, ',', '.'), $converted);
            $converted = preg_replace('/%merchantfee%/', 'Rp ' . number_format($data['fee_merchant'], 0, ',', '.'), $converted);
            $converted = preg_replace('/%nominaltagihan%/', 'Rp ' . number_format($data['amount'], 0, ',', '.'), $converted);
            $converted = preg_replace('/%statuspayment%/', $data['status'], $converted);
            $converted = preg_replace('/%paybefore%/', date('d F Y H:i', $data['expired_time']), $converted);
            $converted = preg_replace('/%carabayar%/', $url_cara_bayar, $converted);
            $converted = preg_replace('/%checkout%/',$data['checkout_url'], $converted);

            // Nama Perusahaan dan Keterangan Lainnya
            $aliasperusahaan = Setting::find(6);
            $namaperusahaan = Setting::find(23);
            $val1 = Setting::find(24);
            $val2 = Setting::find(25);
            $val3 = Setting::find(26);
            $val4 = Setting::find(27);
            $alamatperusahaan = ($val1->value.', '.$val2->value.', '.$val3->value.' - '.$val4->value);
            $phone = Setting::find(29);
            $phonealternate = Setting::find(19);
            $urlperusahaan = Setting::find(20);

            $converted = preg_replace('/%aliasperusahaan%/', $aliasperusahaan->value, $converted);
            $converted = preg_replace('/%namaperusahaan%/', $namaperusahaan->value, $converted);
            $converted = preg_replace('/%alamatperusahaan%/', $alamatperusahaan, $converted);
            $converted = preg_replace('/%phone%/', $phone->value , $converted);
            $converted = preg_replace('/%phonealternate%/', $phonealternate->value, $converted);
            $converted = preg_replace('/%urlperusahaan%/', $urlperusahaan->value, $converted);

            if($data){
                $curl = curl_init();

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
                        'target' => convert_phone($inv->nomor_telephone),
                        'message' => $converted,
                        'countryCode' => '62', //optional
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: '.$set->value //change TOKEN to your actual token
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                $check = Transaction::where('merchant_ref','=', $inv->invoice_number)->get();
                if($check->count() > 2){
                    $check_last = Transaction::where('merchant_ref','=', $inv->invoice_number)
                    ->where('status','=','UNPAID')
                    ->first();
                    $check_last->delete();
                }else{
                    Transaction::create($data);
                }
            }

            return view('tripay::result', compact('data', 'profile'));
        }catch(Exception $errors){
            $errors = "Oops! Something went wrong nomor Invoice tidak tepat";
            return view('tripay::failed', compact('profile', $errors));
        }
    }

    public function checkstatus(Request $request){
        try{
            $profile = Setting::all();
            $apiKey = Setting::find(47);
            $privateKey   = Setting::find(48);
            $merchantCode = Setting::find(50);
            $tripay_sand_box = Setting::find(49);
            if($tripay_sand_box->value == 'on'){
                $tripay_url = "https://tripay.co.id/api-sandbox/";
            }else{
                $tripay_url = "https://tripay.co.id/api/";
            }
            $request->validate([
                'reference'=> 'required',
            ]);

            $payload = ['reference'	=>  $request->reference];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => $tripay_url . 'transaction/detail?'.http_build_query($payload),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey->value],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            $test = json_decode($response, TRUE);
            $data = $test['data'];
            if($test['success'] == true){
                // Status Payed
                if($data['status'] == "PAID"){
                    // PAID
                    $ordel = OrderDetail::where('invoice_number', $data['merchant_ref'])->first();
                    $ordel->is_payed = 1;
                    $ordel->save();
                    $transdel = Transaction::where('merchant_ref', $data['merchant_ref'])->first();
                    $transdel->status = "PAID";
                    $transdel->save();
                }else if($data['status'] == "EXPIRED"){
                    // EXPIRED
                    $transdel = Transaction::where('merchant_ref', $data['merchant_ref'])->first();
                    $transdel->status = "EXPIRED";
                    $transdel->save();
                }else if($data['status'] == "REFUND"){
                    // REFUND
                    $transdel = Transaction::where('merchant_ref', $data['merchant_ref'])->first();
                    $transdel->status = "REFUND";
                    $transdel->save();
                }else if($data['status'] == "FAILED"){
                    // FAILED
                    $transdel = Transaction::where('merchant_ref', $data['merchant_ref'])->first();
                    $transdel->status = "FAILED";
                    $transdel->save();
                }else if($data['status'] == "UNPAID"){
                    // UNPAID
                    $transdel = Transaction::where('merchant_ref', $data['merchant_ref'])->first();
                    $transdel->status = "UNPAID";
                    $transdel->save();
                }else{
                    $errors = "Status Payment Not Valid";
                    return redirect()->route('tripay.failed', $errors);
                }
                return view('tripay::checkstatus', compact('data', 'profile'));
            }else{
                $errors = "Ref Transaction Not Found";
                return redirect()->route('tripay.failed', $errors);
            }


        }catch (\Exception $e) {
            $errors = "Ref Transaction Not Found";
            return redirect()->route('tripay.failed', $errors);
        }

    }
}
