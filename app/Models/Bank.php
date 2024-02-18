<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'banks';

    protected $fillable = [
        'nama_bank',
        'nama_akun',
        'nomor_akun_rekening',
        'payment_id',
        'is_active',
    ];

    public function paymenttype()
    {
        return $this->hasMany(PaymentType::class, 'id', 'payment_id');
    }
}
