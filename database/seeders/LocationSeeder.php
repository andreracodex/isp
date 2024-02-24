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
            'nama_locations'=> 'Lokasi 1',
            'alamat_locations'=> 'Jl. test 1',
            'employee_id' => 1,
            'created_at' => Carbon::now(),
        ]);
        DB::table('locations')->insert([
            'nama_locations'=> 'Lokasi 2',
            'alamat_locations'=> 'Jl. test 2',
            'employee_id' => 2,
            'created_at' => Carbon::now(),
        ]);
        DB::table('locations')->insert([
            'nama_locations'=> 'Lokasi 3',
            'alamat_locations'=> 'Jl. test 3',
            'employee_id' => 3,
            'created_at' => Carbon::now(),
        ]);
        DB::table('locations')->insert([
            'nama_locations'=> 'Lokasi 4',
            'alamat_locations'=> 'Jl. test 4',
            'employee_id' => 4,
            'created_at' => Carbon::now(),
        ]);
        DB::table('locations')->insert([
            'nama_locations'=> 'Lokasi 5',
            'alamat_locations'=> 'Jl. test 5',
            'employee_id' => 5,
            'created_at' => Carbon::now(),
        ]);
    }
}
