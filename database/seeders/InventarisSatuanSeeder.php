<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventarisSatuanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('inventaris_satuans')->insert([
            'nama' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris_satuans')->insert([
            'nama' => 'meter',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris_satuans')->insert([
            'nama' => 'kg',
            'created_at' => Carbon::now(),
        ]);
    }
}
