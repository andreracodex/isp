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

        \App\Models\Customer::factory(100)->create();
        \App\Models\Employee::factory(20)->create();

        $this->call([
            LocationSeeder::class,
            InventarisKategoriSeeder::class,
            InventarisSeeder::class,
        ]);
    }
}
