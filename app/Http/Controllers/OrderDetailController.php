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

    public function updatestatus(string $id)
    {
        $orderdetail = OrderDetail::where('id', '=', $id)->first();

        if ($orderdetail != null) {
            if ($orderdetail->is_payed == 0) {
                $order = Order::leftJoin('customers', 'customers.id', '=', 'orders.customer_id')->where('orders.id', '=', $orderdetail->order_id)->first();
                if ($order != null) {
                    $orderdetail->update([
                        'is_payed' => 1
                    ]);
                    $set = Setting::find(46);
                    $was = SettingsWA::find(7);

                    if ($was->is_active == 1) {
                        // Send WhatsApp message
                        $message = "*Yth Pelanggan GNET*\n\n";
                        $message .= "Hallo Bapak/Ibu,\n";
                        $message .= "*" . $order->nama_customer . "*,\n\n";
                        $message .= "Pembayaran internet telah berhasil dilakukan.\n";
                        $message .= "Via : *CASH / TRANSFER*.\n";
                        $message .= "Tanggal Pembayaran : *" . Carbon::now()->format('d F Y') . "*.\n";
                        $message .= "No Invocie Tagihan : *" . $orderdetail->invoice_number . "*\n";
                        $message .= "Bulan : *" . Carbon::parse($orderdetail->due_date)->format('F Y') . "*\n\n";
                        $message .= "Kami ingin mengucapkan terima kasih atas kepercayaan Anda menggunakan layanan internet kami.\n";
                        $message .= "Semoga layanan yang kami berikan dapat memenuhi kebutuhan Anda dengan baik.\n";
                        $message .= "Terima kasih atas dukungan dan kesetiaan Anda sebagai pelanggan kami.\n\n";
                        $message .= "Hormat kami\n*PT. Global Data Network*\nJl. Dinoyo Tenun No 109, RT.006/RW.003, Kel, Keputran, Kec, Tegalsari, Kota Surabaya, Jawa Timur 60265.\nPhone : 085731770730 / 085648747901\n";

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
                                'message' => $message,
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
