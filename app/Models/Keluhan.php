<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keluhan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keluhans';

    protected $fillable = [
        'deskripsi',
        'image',
        'created_by',
        'is_active',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id');
    }
}
