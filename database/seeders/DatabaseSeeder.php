<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            PaymentTypeSeeder::class,
            BankSeeder::class,
        ]);
        \App\Models\Customer::factory(100)->create();
    }
}
