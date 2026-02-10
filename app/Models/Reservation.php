<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';

    protected $fillable = [
        'status_of_reservation',
        'date_time',
        'type_reservation',
        'user_id',
        'parking_spot_id',
        'vehicle_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parkingSpot()
    {
        return $this->belongsTo(ParkingSpot::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
