<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketWa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wa_paket';

    protected $fillable = [
        'nama_paket',
        'jenis_paket',
        'harga_paket',
        'duration',
        'jumlah_pesan',
        'disc',
    ];

    public function wa()
    {
        return $this->belongsTo(Wa::class, 'id');
    }
}
