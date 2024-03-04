<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarisSatuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventaris_satuans';

    protected $fillable = [
        'nama',
        'is_active',
    ];

    public function satinve()
    {
        return $this->hasMany(Inventaris::class, 'satuan_id', 'id');
    }
}
