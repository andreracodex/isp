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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')   ;
            $table->string('nama_customer', 100);
            $table->string('gender');
            $table->string('nomor_layanan');
            $table->integer('location_id');
            $table->string('alamat_customer');
            $table->string('kecamatan_customer');
            $table->string('desa_customer');
            $table->string('kodepos_customer');
            $table->string('nomor_telephone');
            $table->integer('paket_id');
            $table->string('ip_config');
            $table->integer('is_active')->default(1);
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
