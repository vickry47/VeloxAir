<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_id', 
        'seat_number', 
        'class',
        'is_emergency_exit',
        'is_booked',
        'price_multiplier'
    ];

    protected $casts = [
        'is_emergency_exit' => 'boolean',
        'is_booked' => 'boolean',
        'price_multiplier' => 'decimal:2',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    // Scope untuk kursi available
    public function scopeAvailable($query)
    {
        return $query->where('is_booked', false);
    }

    public function scopeByClass($query, $class)
    {
        return $query->where('class', $class);
    }
}