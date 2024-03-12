<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;

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
        $customers = Customer::where('is_active',1)->get();
        foreach ($customers as $customer){
            $list = Order::where('customer_id', '=', $customer->id)->orderBy('created_at', 'DESC')->first();
            $count = Order::where('customer_id', '=', $customer->id)->where('due_date', Carbon::now()->addMonth(1)->format('Y-m-d'))->count();
            if($count == 0){
                $order = Order::create([
                    'customer_id' => $list->customer_id,
                    'location_id' => $list->location_id,
                    'paket_id' => $list->paket_id,
                    'biaya_pasang' => 0,
                    'installed_date' => $list->installed_date,
                    'installed_status' => 0,
                    'order_date' => $list->order_date,
                    'due_date' => Carbon::now()->addMonth(1)->format('Y-m-d'),
                ]);

                $orderdetail = OrderDetail::create([
                    'order_id' => $order->id,
                ]);
                var_dump('Input Tagihan : '.$list->customer->nama_customer. '');
            }else{
                var_dump('Sudah ada tagihan customer : ' .$list->customer->nama_customer. '');
            }
        }
    }
}
