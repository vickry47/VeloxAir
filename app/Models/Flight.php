<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'plane_id',
        'from',
        'to',
        'departure_time',
        'arrival_time',
        'price_per_seat'
    ];

    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
