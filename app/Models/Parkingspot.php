<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parkingspot extends Model
{
    protected $fillable = ['location', 'type', 'status', 'vehicle_fuel_type'];

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

}
