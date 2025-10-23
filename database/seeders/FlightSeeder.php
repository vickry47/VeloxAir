<?php

namespace Database\Seeders;

use App\Models\Flight;
use App\Models\Plane;
use App\Models\Airport;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        $plane1 = Plane::where('model', 'Boeing 737-800')->first();
        $plane2 = Plane::where('model', 'Airbus A320neo')->first();
        
        $cgk = Airport::where('code', 'CGK')->first();
        $dps = Airport::where('code', 'DPS')->first();
        $sub = Airport::where('code', 'SUB')->first();
        $kno = Airport::where('code', 'KNO')->first();

        Flight::create([
            'plane_id' => $plane1->id,
            'origin_airport_id' => $cgk->id,
            'destination_airport_id' => $dps->id,
            'flight_number' => 'GA801',
            'departure_time' => Carbon::now()->addDays(1)->setTime(8, 0, 0),
            'arrival_time' => Carbon::now()->addDays(1)->setTime(11, 30, 0),
            'duration_minutes' => 150,
            'price_per_seat' => 750000.00,
            'available_seats' => 189,
            'status' => 'active',
        ]);

        Flight::create([
            'plane_id' => $plane2->id,
            'origin_airport_id' => $sub->id,
            'destination_airport_id' => $kno->id,
            'flight_number' => 'SQ402',
            'departure_time' => Carbon::now()->addDays(2)->setTime(14, 30, 0),
            'arrival_time' => Carbon::now()->addDays(2)->setTime(17, 45, 0),
            'duration_minutes' => 195,
            'price_per_seat' => 1200000.00,
            'available_seats' => 180,
            'status' => 'active',
        ]);

        Flight::create([
            'plane_id' => $plane1->id,
            'origin_airport_id' => $dps->id,
            'destination_airport_id' => $cgk->id,
            'flight_number' => 'GA802',
            'departure_time' => Carbon::now()->addDays(1)->setTime(13, 0, 0),
            'arrival_time' => Carbon::now()->addDays(1)->setTime(16, 30, 0),
            'duration_minutes' => 150,
            'price_per_seat' => 720000.00,
            'available_seats' => 189,
            'status' => 'active',
        ]);
    }
}