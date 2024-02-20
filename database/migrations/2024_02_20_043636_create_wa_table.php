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
        Schema::create('wa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_device');
            $table->string('nomor_device');
            $table->string('token_device')->max(10);
            $table->integer('pin')->max(6);
            $table->integer('is_active');
            $table->boolean('connection_state')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wa');
    }
};
