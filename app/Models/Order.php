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
        'path_ktp',
        'path_image_rumah',
        'installed_date',
        'installed_image',
        'installed_status',
        'is_active',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

}
