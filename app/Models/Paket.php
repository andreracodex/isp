<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pakets';

    protected $fillable = [
        'nama_paket',
        'jenis_paket',
        'harga_paket',
        'disc',
    ];

    public function paketcustomer()
    {
        return $this->belongsTo(Customer::class, 'paket_id', 'id');
    }
}
