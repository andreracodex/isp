<?php

namespace App\Console\Commands;

use App\Mail\OrderCreated;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class Sendtagihan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:tagihan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Tagihan To Customer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $customers = Customer::where('is_active', 1)->get();

        foreach ($customers as $customer) {
            $list = Order::where('customer_id', '=', $customer->id)->orderBy('created_at', 'DESC')->first();
            $count = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')->orderBy('order_details.order_id', 'ASC')->where('customer_id', '=', $customer->id)->where('due_date', Carbon::now()->addMonth(1)->format('Y-m-d'))->count();
            dd($count);
            if ($count == 0) {
                $order = Order::create([
                    'customer_id' => $list->customer_id,
                    'location_id' => $list->location_id,
                    'paket_id' => $list->paket_id,
                    'biaya_pasang' => 0,
                    'installed_date' => $list->installed_date,
                    'installed_status' => $list->installed_status,
                ]);

                OrderDetail::create([
                    'due_date' => Carbon::parse($list->due_date)->addMonth(1)->format('Y-m-d'),
                    'payment_id' => $list->payment_id,
                    'order_id' => $order->id,
                ]);


                Mail::to($customer->user->email)->send(new OrderCreated($customer));
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
                        'target' => $customer->nomor_telephone,
                        'message' => 'test message',
                        'countryCode' => '62', //optional
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Ap+@#H3Bk464yp3kaSBo' //change TOKEN to your actual token
                    ),
                ));

                $response = curl_exec($curl);
                if (curl_errno($curl)) {
                    $error_msg = curl_error($curl);
                }
                curl_close($curl);

                if (isset($error_msg)) {
                    var_dump($error_msg);
                }
                echo $response;
                var_dump('Input Tagihan : ' . $list->customer->nama_customer . '');
            } else {
                var_dump('Sudah ada tagihan customer : ' . $list->customer->nama_customer . '');
            }
        }
    }
}
