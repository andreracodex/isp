<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'uuid',
        'invoice_number',
        'payment_id',
        'pay_image',
        'pay_description',
        'diskon',
        'biaya_admin',
        'ppn',
        'due_date',
        'is_payed',
        'is_active',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function paymenttype()
    {
        return $this->belongsTo(PaymentType::class, 'payment_id', 'id');
    }
}
