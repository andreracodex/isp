<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
    }

}
