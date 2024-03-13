<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Periode;
use Carbon\Carbon;
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

        \App\Models\Employee::factory(2)->create();

        $this->call([
            LocationSeeder::class,
            InventarisKategoriSeeder::class,
            InventarisSatuanSeeder::class,
            InventarisSeeder::class,
        ]);

        \App\Models\Customer::factory(10)->create();
        \App\Models\Order::factory(100)->create();
        \App\Models\OrderDetail::factory(100)->create();

        $startDate = Carbon::create(2023, 1, 1);
        $endDate = Carbon::create(2024, 12, 1);

        while ($startDate->lessThanOrEqualTo($endDate)) {
            Periode::create(['bulan_periode' => $startDate]);
            $startDate->addMonth();
        }
    }
}
