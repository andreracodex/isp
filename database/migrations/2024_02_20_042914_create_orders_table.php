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
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedBigInteger('paket_id')->nullable();
            $table->foreign('paket_id')->references('id')->on('pakets');
            $table->unsignedBigInteger('coordinates_id')->nullable();
            $table->foreign('coordinates_id')->references('id')->on('coordinates');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payment_types');
            $table->float('diskon')->default(0);
            $table->float('biaya_pasang')->default(0);
            $table->text('path_ktp')->nullable();
            $table->text('path_image_rumah')->nullable();
            $table->date('order_date');
            $table->date('installed_date')->nullable();
            $table->text('installed_image')->nullable();
            $table->integer('installed_status')->default(0);
            $table->date('due_date'); //tanggal jatuh tempo
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
        Schema::dropIfExists('orders');
    }
};
