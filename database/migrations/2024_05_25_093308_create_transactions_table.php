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
        Schema::create('transactions_tripay', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('merchant_ref');
            $table->string('payment_selection_type');
            $table->string('payment_method');
            $table->string('payment_name');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('callback_url');
            $table->string('return_url')->nullable();
            $table->double('amount');
            $table->double('fee_merchant');
            $table->double('fee_customer');
            $table->double('total_fee');
            $table->double('amount_received');
            $table->string('pay_code');
            $table->string('pay_url')->nullable();
            $table->string('checkout_url');
            $table->string('status');
            $table->text('expired_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_tripay');
    }
};
