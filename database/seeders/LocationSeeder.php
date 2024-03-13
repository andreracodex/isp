<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('locations')->insert([
            'nama_location'=> 'Lokasi 1',
            'alamat_location'=> 'Jl. test 1',
            'employee_id' => 1,
            'created_at' => Carbon::now(),
        ]);
        DB::table('locations')->insert([
            'nama_location'=> 'Lokasi 2',
            'alamat_location'=> 'Jl. test 2',
            'employee_id' => 2,
            'created_at' => Carbon::now(),
        ]);
        DB::table('locations')->insert([
            'nama_location'=> 'Lokasi 3',
            'alamat_location'=> 'Jl. test 3',
            'employee_id' => 1,
            'created_at' => Carbon::now(),
        ]);
        DB::table('locations')->insert([
            'nama_location'=> 'Lokasi 4',
            'alamat_location'=> 'Jl. test 4',
            'employee_id' => 2,
            'created_at' => Carbon::now(),
        ]);
        DB::table('locations')->insert([
            'nama_location'=> 'Lokasi 5',
            'alamat_location'=> 'Jl. test 5',
            'employee_id' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
