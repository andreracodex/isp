<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer');
            $table->string('jenis_kelamin');
            $table->string('nomor_layanan');
            $table->string('location_id');
            $table->string('alamat_customer');
            $table->string('kecamatan_customer');
            $table->string('desa_customer');
            $table->string('kodepos_customer');
            $table->string('nomor_telephone');
            $table->string('paket_id');
            $table->string('ip_config');
            $table->integer('is_active')->default(1);;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
