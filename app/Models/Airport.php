<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name', 
        'city',
        'country'
    ];

    // Relasi dengan flights sebagai bandara asal
    public function departingFlights()
    {
        return $this->hasMany(Flight::class, 'origin_airport_id');
    }

    // Relasi dengan flights sebagai bandara tujuan
    public function arrivingFlights()
    {
        return $this->hasMany(Flight::class, 'destination_airport_id');
    }

    // Accessor untuk nama lengkap
    public function getFullNameAttribute()
    {
        return "{$this->name} ({$this->code})";
    }

    // Accessor untuk lokasi lengkap
    public function getFullLocationAttribute()
    {
        return "{$this->city}, {$this->country}";
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
    }
}