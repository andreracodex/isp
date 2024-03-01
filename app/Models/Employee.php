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
        'alamat_karyawan',
        'kecamatan_karyawan',
        'desa_karyawan',
        'kodepos_karyawan',
        'nomor_telephone',
        'ip_config',
        'is_active',
        'gaji_pokok',
    ];

    public function location()
    {
        return $this->hasOne(Location::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
