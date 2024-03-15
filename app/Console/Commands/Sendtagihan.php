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
            $first = Carbon::now()->addMonth(1)->firstOfMonth()->format('Y-m-d');
            $last = Carbon::now()->addMonth(1)->lastOfMonth()->format('Y-m-d');

            $count = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.customer_id', '=', $customer->id)
            ->whereBetween('due_date', [$first, $last])
            ->orderBy('order_id', 'DESC')
            ->groupBy('orders.customer_id', 'due_date','order_details.id')
            ->count();

            $first_month = Carbon::now()->firstOfMonth()->format('Y-m-d');
            $last_month = Carbon::now()->lastOfMonth()->format('Y-m-d');

            $list = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.customer_id', '=', $customer->id)
            ->whereBetween('due_date', [$first_month, $last_month])
            ->orderBy('order_id', 'DESC')
            ->groupBy('orders.customer_id', 'due_date','order_details.id')
            ->first();

            if ($count == 0) {
                OrderDetail::create([
                    'due_date' => Carbon::parse($list->due_date)->addMonth(1)->format('Y-m-d'),
                    'payment_id' => $list->payment_id,
                    'order_id' => $list->id,
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
                var_dump('================================');
                var_dump('Berhasil Mengirim : ' . $list->order->customer->nama_customer);
                var_dump('Nomor Pelanggan : '.$list->order->customer->nomor_layanan);
                var_dump('Via WA dan Email');
                var_dump('================================');
                $isi = json_decode($response, true);
                var_dump($isi['detail']);
                var_dump($isi['process']);
                var_dump('================================');
            } else {
                var_dump('================================');
                var_dump('Sudah ada tagihan customer : ' . $list->order->customer->nama_customer);
                var_dump('Nomor Pelanggan : '.$list->order->customer->nomor_layanan);
                var_dump('Via WA dan Email');
                var_dump('================================');
            }
        }
    }
}
