<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsWA extends Model
{
    use HasFactory;

    protected $table = 'settings_wa';

    protected $fillable = [
        'nama_settings',
        'value',
        'is_active',
    ];

}
