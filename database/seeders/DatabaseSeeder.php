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
            IndoRegionSeeder::class
        ]);

        \App\Models\Employee::factory(10)->create();

        $this->call([
            LocationSeeder::class,
            InventarisKategoriSeeder::class,
            InventarisSeeder::class,
        ]);

        // \App\Models\Customer::factory(50)->create();
        // \App\Models\Order::factory(10)->create();
    }
}
