<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function locationcustomer()
    {
        return $this->belongsTo(Customer::class, 'location_id', 'id');
    }
}
