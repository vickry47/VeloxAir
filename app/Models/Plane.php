<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id', 
        'model', 
        'registration_number',
        'seat_capacity',
        'business_class_seats',
        'economy_class_seats',
        'status'
    ];

    protected $casts = [
        'business_class_seats' => 'integer',
        'economy_class_seats' => 'integer',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    // Method untuk cek ketersediaan
    public function isActive()
    {
        return $this->status === 'active';
    }
}