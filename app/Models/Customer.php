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
        'nama_customer',
        'jenis_kelamin',
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

    public function location()
    {
        return $this->hasMany(Location::class, 'id', 'location_id');
    }

    public function paket()
    {
        return $this->hasMany(Paket::class, 'id', 'paket_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id');
    }
}
