<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'transactions_tripay';
    protected $fillable = [
        'reference',
        'merchant_ref',
        'payment_selection_type',
        'payment_method',
        'payment_name',
        'customer_name',
        'customer_email',
        'customer_phone',
        'callback_url',
        'return_url',
        'amount',
        'fee_merchant',
        'fee_customer',
        'total_fee',
        'amount_received',
        'pay_code',
        'pay_url',
        'checkout_url',
        'status',
        'expired_time',
    ];
}
