<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Periode;
use App\Models\Setting;
use App\Models\SettingsWA;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;

use function App\Http\Helpers\convert_phone;

class OrderDetailController extends Controller
{
    public function view(OrderDetail $orderdetail)
    {
        $orderdetail = OrderDetail::find($orderdetail->id);
        $profile = Setting::all();

        return view(
            'backend.pages.orderdetail.view',
            compact('profile', 'orderdetail')
        );
    }

    public function print(Request $request)
    {
        $orderdetail = OrderDetail::where('uuid', $request->uuid)->first();
        $profile = Setting::all();

        if($orderdetail == null){
            return abort(403);
        }
        return view(
            'backend.pages.pdf.invoice',
            compact('profile', 'orderdetail')
        );
    }

    public function updatestatus(Request $request, string $id)
    {
        $orderdetail = OrderDetail::where('id', '=', $id)->first();

        if ($orderdetail != null) {
            if ($orderdetail->is_payed == 0) {
                $order = Order::leftJoin('customers', 'customers.id', '=', 'orders.customer_id')->where('orders.id', '=', $orderdetail->order_id)->first();
                if ($order != null) {
                    if($request->name == "cash"){
                        $metode_bayar = "CASH";
                        // $orderdetail->update([
                        //     'is_payed' => 2
                        // ]);
                    }elseif($request->name == "transfer"){
                        $metode_bayar = "TRANSFER";
                        // $orderdetail->update([
                        //     'is_payed' => 1
                        // ]);
                    }else{
                        $metode_bayar = "E-Wallet";
                        // $orderdetail->update([
                        //     'is_payed' => 3
                        // ]);
                    }
                    $orderdetail->update([
                        'is_payed' => 1
                    ]);
                    $set = Setting::find(46);
                    $was = SettingsWA::find(7);

                    if ($was->is_active == 1) {
                        $message = Setting::find(52);
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

                        $converted = preg_replace('/%customer%/', $order->nama_customer, $converted);
                        $converted = preg_replace('/%invoices%/', $orderdetail->invoice_number, $converted);
                        $converted = preg_replace('/%bulantahun%/', Carbon::parse($orderdetail->due_date)->format('F Y'), $converted);
                        $converted = preg_replace('/%metode_bayar%/', $metode_bayar, $converted);
                        $converted = preg_replace('/%tanggalbayar%/', Carbon::parse($orderdetail->created_at)->format('d F Y'), $converted);

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
                                'target' => convert_phone($order->nomor_telephone),
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
                    return redirect()->back()->with(['success' => 'Tagihan sudah dibayarkan lunas !']);
                }else{
                    return redirect()->back()->with(['error' => 'Gagal tagihan belum lunas !']);
                }
            } else {
                return redirect()->back()->with(['success' => 'Tagihan sudah dibayarkan lunas !']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Gagal tagihan belum lunas !']);
        }
    }
}
