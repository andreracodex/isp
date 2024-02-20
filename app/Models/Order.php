<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'location_id',
        'paket_id',
        'coordinates_id',
        'payment_id',
        'diskon',
        'path_ktp',
        'path_image_rumah',
        'order_date',
        'is_active',
    ];

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_id', 'id');
    }

}
