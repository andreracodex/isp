<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('banks')->insert([
            'payment_id' => 1,
            'kode_bank' => '002',
            'nama_bank' => 'BRI',
            'nama_akun' => 'PUTUT WAHYUDI',
            'nomor_akun_rekening' => '319201004897506',
            'created_at' => Carbon::now(),
        ]);

        DB::table('banks')->insert([
            'payment_id' => 1,
            'kode_bank' => '009',
            'nama_bank' => 'BNI',
            'nama_akun' => 'PUTUT WAHYUDI',
            'nomor_akun_rekening' => '1255306543',
            'created_at' => Carbon::now(),
        ]);

        DB::table('banks')->insert([
            'payment_id' => 1,
            'kode_bank' => '014',
            'nama_bank' => 'BCA',
            'nama_akun' => 'PUTUT WAHYUDI',
            'nomor_akun_rekening' => '8220725511',
            'created_at' => Carbon::now(),
        ]);

        DB::table('banks')->insert([
            'payment_id' => 1,
            'kode_bank' => '008',
            'nama_bank' => 'Mandiri',
            'nama_akun' => 'PUTUT WAHYUDI',
            'nomor_akun_rekening' => '1410014462964',
            'created_at' => Carbon::now(),
        ]);
    }
}
