<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'plane_id',
        'origin_airport_id',
        'destination_airport_id', 
        'flight_number',
        'departure_time',
        'arrival_time',
        'duration_minutes',
        'price_per_seat',
        'available_seats',
        'status'
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'price_per_seat' => 'decimal:2',
    ];

    // ===================== RELATIONS =====================

    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }

    public function originAirport()
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    // ===================== ACCESSORS =====================

    public function getFormattedDepartureTimeAttribute()
    {
        return $this->departure_time->format('H:i');
    }

    public function getFormattedArrivalTimeAttribute()
    {
        return $this->arrival_time->format('H:i');
    }

    public function getFormattedDepartureDateAttribute()
    {
        return $this->departure_time->format('d M Y');
    }

    public function getFormattedArrivalDateAttribute()
    {
        return $this->arrival_time->format('d M Y');
    }

    public function getOriginCityAttribute()
    {
        return $this->originAirport ? $this->originAirport->city : null;
    }

    public function getDestinationCityAttribute()
    {
        return $this->destinationAirport ? $this->destinationAirport->city : null;
    }

    public function getDurationAttribute()
    {
        if ($this->departure_time && $this->arrival_time) {
            $diff = $this->departure_time->diff($this->arrival_time);
            return $diff->h . 'j ' . $diff->i . 'm';
        }
        return null;
    }

    public function getHasDepartedAttribute()
    {
        return $this->departure_time < now();
    }

    public function getCanBeBookedAttribute()
    {
        return $this->status === 'active' && 
               !$this->has_departed && 
               $this->has_available_seats;
    }

    // ===================== METHODS =====================

    public function hasAvailableSeats()
    {
        return $this->available_seats > 0;
    }

    public function decreaseAvailableSeats($count = 1)
    {
        $this->available_seats = max(0, $this->available_seats - $count);
        return $this->save();
    }

    public function increaseAvailableSeats($count = 1)
    {
        $this->available_seats += $count;
        return $this->save();
    }

    // ✅ Tambahan: Method untuk validasi aktif
    public function isActive()
    {
        return $this->status === 'active' && $this->departure_time > now();
    }

    // ===================== SCOPES =====================

    public function scopeSearch(Builder $query, $origin, $destination, $date = null)
    {
        return $query->whereHas('originAirport', function($q) use ($origin) {
                    $q->where('code', $origin)->orWhere('city', 'like', "%$origin%");
                })
                ->whereHas('destinationAirport', function($q) use ($destination) {
                    $q->where('code', $destination)->orWhere('city', 'like', "%$destination%");
                })
                ->when($date, function($q) use ($date) {
                    $q->whereDate('departure_time', $date);
                });
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active')
                     ->where('departure_time', '>', now());
    }

    public function scopeUpcoming(Builder $query)
    {
        return $query->where('departure_time', '>', now())
                     ->orderBy('departure_time', 'asc');
    }
}