<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Setting;
use Illuminate\Console\Command;

class Sendtagihan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sendtagihan';

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
        $customer = Customer::where('is_active',1)->get();
        $setting = Setting::find(34)->first();
        foreach ($customer as $customer){
            var_dump($customer->nama_customer, $setting);
        }
    }
}
