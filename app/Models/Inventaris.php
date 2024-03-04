<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventaris extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventaris';

    protected $fillable = [
        'location_id',
        'nama_barang',
        'jenis_id',
        'jumlah_barang',
        'is_active',
        'satuan_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(InventarisKategori::class, 'jenis_id', 'id');
    }

    public function satuan()
    {
        return $this->belongsTo(InventarisSatuan::class, 'satuan_id', 'id');
    }
}
