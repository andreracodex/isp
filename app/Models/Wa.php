<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wa extends Model
{
    use HasFactory;

    protected $table = 'wa';

    protected $fillable = [
        'nama_device',
        'nomor_device',
        'token_device',
        'pin',
        'is_active',
        'connection_state',
    ];
}
