<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';

    protected $fillable = [
        'employee_id',
        'nama_location',
        'alamat_location',
        'is_active',
    ];

    public function locationcustomer()
    {
        return $this->belongsTo(Customer::class, 'location_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function inventaris()
    {
        return $this->hasMany(Inventaris::class, 'location_id', 'id');
    }
}
