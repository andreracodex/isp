<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tickets';

    protected $fillable = [
        'customer_id',
        'keluhan_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id', 'customer_id');
    }
}
