<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWa extends Model
{
    use HasFactory;

    protected $table = 'paket_wa';

    protected $fillable = [
        'nama_paket',
        'jenis_paket',
        'harga_paket',
        'jumlah_pesan',
        'disc',
    ];
}
