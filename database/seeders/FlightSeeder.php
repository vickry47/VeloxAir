<?php

namespace Database\Seeders;

use App\Models\Flight;
use App\Models\Plane;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plane1 = Plane::where('model', 'Boeing 737')->first();
        $plane2 = Plane::where('model', 'Airbus A320')->first();

        Flight::create([
            'plane_id' => $plane1->id,
            'origin' => 'Jakarta',
            'destination' => 'Bali',
            'departure_time' => '2025-10-25 08:00:00',
            'price_per_seat' => 750000.00,
        ]);

        Flight::create([
            'plane_id' => $plane2->id,
            'origin' => 'Surabaya',
            'destination' => 'Singapore',
            'departure_time' => '2025-10-26 09:30:00',
            'price_per_seat' => 1500000.00,
        ]);
    }
}
