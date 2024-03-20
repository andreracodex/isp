<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_types')->insert([
            'payment_methode_name' => 'Transfer',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('payment_types')->insert([
            'payment_methode_name' => 'Cash',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('payment_types')->insert([
            'payment_methode_name' => 'E-Wallet',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
