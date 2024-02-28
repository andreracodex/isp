<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventarisKategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('inventaris_kategoris')->insert([
            'nama' => 'Router',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris_kategoris')->insert([
            'nama' => 'Kabel Fiber',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris_kategoris')->insert([
            'nama' => 'Konektor RJ-45',
            'created_at' => Carbon::now(),
        ]);
    }
}
