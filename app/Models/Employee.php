<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'user_id',
        'nama_karyawan',
        'gender',
        'nomor_ktp',
        'alamat_karyawan',
        'kelurahan_id',
        'kodepos_karyawan',
        'nomor_telephone',
        'ip_config',
        'gaji_pokok',
        'is_active',
    ];

    public function location()
    {
        return $this->hasOne(Location::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'kelurahan_id');
    }
}
