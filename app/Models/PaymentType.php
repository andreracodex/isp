<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_types';

    protected $fillable = [
        'payment_methode_name',
        'is_active',
    ];

    public function banks()
    {
        return $this->hasMany(Bank::class, 'payment_id', 'id');
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class, 'payment_id', 'id');
    }
}
