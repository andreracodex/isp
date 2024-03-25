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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->string('uuid')->unique();
            $table->string('invoice_number');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payment_types');
            $table->text('pay_image')->nullable();
            $table->text('pay_description')->nullable();
            $table->double('diskon')->default(0);
            $table->double('biaya_admin')->default(0);
            $table->double('ppn')->default(0);
            $table->datetime('due_date')->nullable(); //tanggal jatuh tempo
            $table->integer('is_payed')->default(0);
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
        Schema::dropIfExists('order_details');
    }
};
