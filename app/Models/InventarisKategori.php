<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarisKategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventaris_kategoris';

    protected $fillable = [
        'nama',
        'is_active',
    ];

    public function inventaris()
    {
        return $this->hasMany(Inventaris::class, 'jenis_id', 'id');
    }
}
