<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketKategori extends Model
{
    use HasFactory;

    protected $table = 'ticket_kategoris';

    protected $fillable = [
        'nama',
        'is_active',
    ];

    public function ticket()
    {
        return $this->hasMany(Ticket::class, 'ticket_kat_id', 'id');
    }
}
