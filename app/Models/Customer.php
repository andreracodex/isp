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
        'location_id',
        'alamat_customer',
        'kecamatan_customer',
        'desa_customer',
        'kodepos_customer',
        'nomor_telephone',
        'paket_id',
        'ip_config',
        'is_active',
    ];

    public function coordinate()
    {
        return $this->hasOne(Coordinate::class, 'id', 'location_id');
    }

    public function paket()
    {
        return $this->hasOne(Paket::class, 'id', 'paket_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id');
    }
}
