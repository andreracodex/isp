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
    ];

    public function paymentbank()
    {
        return $this->belongsTo(Bank::class, 'payment_id', 'id');
    }
}
