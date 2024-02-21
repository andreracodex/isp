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
            $table->string('device_name');
            $table->string('device_number')->unique('device_number');
            $table->string('token_device')->max(10)->nullable();
            $table->integer('pin')->max(6)->default(rand(111111, 999999));
            $table->integer('is_active')->default(1);
            $table->unsignedBigInteger('wa_paket_id')->nullable();
            $table->foreign('wa_paket_id')->references('id')->on('wa_paket');
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
