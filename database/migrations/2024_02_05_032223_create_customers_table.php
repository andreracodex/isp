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
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nama_customer', 100);
            $table->string('gender');
            $table->string('nomor_layanan');
            $table->string('nomor_ktp');
            $table->string('alamat_customer');
            $table->char('kelurahan_id', 10);
            $table->foreign('kelurahan_id')
                ->references('id')
                ->on('villages')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->string('kodepos_customer');
            $table->string('nomor_telephone');
            $table->string('ip_config')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('is_new')->default(0);
            $table->integer('is_ppn')->default(0);
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
