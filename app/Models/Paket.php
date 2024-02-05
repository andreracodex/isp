<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    public function paketcustomer()
    {
        return $this->belongsTo(Customer::class, 'paket_id', 'id');
    }
}
