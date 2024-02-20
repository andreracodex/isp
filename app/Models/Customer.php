<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'nama_customer',
        'gender',
        'nomor_layanan',
        'alamat_customer',
        'kecamatan_customer',
        'desa_customer',
        'kodepos_customer',
        'nomor_telephone',
        'ip_config',
        'is_active',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
