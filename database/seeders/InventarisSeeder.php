<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventarisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('inventaris')->insert([
            'location_id' => 1,
            'nama_barang' => 'Router TP-LINK',
            'jenis_id' => 1,
            'jumlah_barang' => 50,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 2,
            'nama_barang' => 'Router TP-LINK',
            'jenis_id' => 1,
            'jumlah_barang' => 50,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 3,
            'nama_barang' => 'Router TP-LINK',
            'jenis_id' => 1,
            'jumlah_barang' => 50,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 4,
            'nama_barang' => 'Router TP-LINK',
            'jenis_id' => 1,
            'jumlah_barang' => 50,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 5,
            'nama_barang' => 'Router TP-LINK',
            'jenis_id' => 1,
            'jumlah_barang' => 50,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);

        // 2
        DB::table('inventaris')->insert([
            'location_id' => 1,
            'nama_barang' => 'Kabel Fiber TP-LINK',
            'jenis_id' => 2,
            'jumlah_barang' => 10000,
            'satuan_barang' => 'meter',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 2,
            'nama_barang' => 'Kabel Fiber TP-LINK',
            'jenis_id' => 2,
            'jumlah_barang' => 10000,
            'satuan_barang' => 'meter',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 3,
            'nama_barang' => 'Kabel Fiber TP-LINK',
            'jenis_id' => 2,
            'jumlah_barang' => 10000,
            'satuan_barang' => 'meter',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 4,
            'nama_barang' => 'Kabel Fiber TP-LINK',
            'jenis_id' => 2,
            'jumlah_barang' => 10000,
            'satuan_barang' => 'meter',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 5,
            'nama_barang' => 'Kabel Fiber TP-LINK',
            'jenis_id' => 2,
            'jumlah_barang' => 10000,
            'satuan_barang' => 'meter',
            'created_at' => Carbon::now(),
        ]);

        // 3
        DB::table('inventaris')->insert([
            'location_id' => 1,
            'nama_barang' => 'Konektor RJ-45',
            'jenis_id' => 3,
            'jumlah_barang' => 1000,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 2,
            'nama_barang' => 'Konektor RJ-45',
            'jenis_id' => 3,
            'jumlah_barang' => 1000,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 3,
            'nama_barang' => 'Konektor RJ-45',
            'jenis_id' => 3,
            'jumlah_barang' => 1000,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 4,
            'nama_barang' => 'Konektor RJ-45',
            'jenis_id' => 3,
            'jumlah_barang' => 1000,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
        DB::table('inventaris')->insert([
            'location_id' => 5,
            'nama_barang' => 'Konektor RJ-45',
            'jenis_id' => 3,
            'jumlah_barang' => 1000,
            'satuan_barang' => 'pcs',
            'created_at' => Carbon::now(),
        ]);
    }
}
