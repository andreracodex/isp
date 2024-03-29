<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coordinate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'coordinates';

    protected $fillable = [
        'longitude',
        'latitude',
        'is_active',
    ];
}
