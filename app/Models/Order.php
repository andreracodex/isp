<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function location()
    {
        return $this->hasMany(Location::class, 'id', 'location_id');
    }

    public function paket()
    {
        return $this->hasMany(Paket::class, 'id', 'paket_id');
    }

    public function customer()
    {
        return $this->hasMany(Customer::class, 'id', 'customer_id');
    }
}
