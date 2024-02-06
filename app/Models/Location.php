<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';

    protected $fillable = [
        'nama_locations',
        'alamat_locations',
        'penanggung_jawab_locations',
        'kontak_penanggung_jawab_locations',
    ];

    public function locationcustomer()
    {
        return $this->belongsTo(Customer::class, 'location_id', 'id');
    }
}
