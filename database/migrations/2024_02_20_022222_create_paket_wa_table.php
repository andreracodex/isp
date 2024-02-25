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
        Schema::create('wa_paket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->string('jenis_paket');
            $table->double('harga_paket');
            $table->integer('jumlah_pesan')->default(0);
            $table->integer('duration')->default(0);
            $table->integer('disc')->default(0);
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
        Schema::dropIfExists('wa_paket');
    }
};
