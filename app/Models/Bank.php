<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public function paymenttype()
    {
        return $this->hasMany(PaymentType::class, 'id', 'payment_id');
    }
}
