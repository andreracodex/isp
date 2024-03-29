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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedBigInteger('paket_id');
            $table->foreign('paket_id')->references('id')->on('pakets');
            $table->double('biaya_pasang')->default(0);
            $table->unsignedBigInteger('coordinates_id')->nullable();
            $table->foreign('coordinates_id')->references('id')->on('coordinates');
            $table->text('path_ktp')->nullable();
            $table->text('path_image_rumah')->nullable();
            $table->datetime('installed_date')->nullable();
            $table->text('installed_image')->nullable();
            $table->integer('installed_status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
