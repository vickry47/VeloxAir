<?php

namespace Database\Seeders;

use App\Models\Plane;
use App\Models\Airline;
use Illuminate\Database\Seeder;

class PlaneSeeder extends Seeder
{
    public function run(): void
    {
        $garuda = Airline::where('code', 'GA')->first();
        $sq = Airline::where('code', 'SQ')->first();
        $airasia = Airline::where('code', 'AK')->first();

        Plane::create([
            'airline_id' => $garuda->id,
            'model' => 'Boeing 737-800',
            'registration_number' => 'PK-GFA',
            'seat_capacity' => 189,
            'business_class_seats' => 12,
            'economy_class_seats' => 177,
            'max_speed' => 876,
            'range' => 5765,
            'manufacture_year' => 2018,
            'status' => 'active',
        ]);

        Plane::create([
            'airline_id' => $sq->id,
            'model' => 'Airbus A320neo',
            'registration_number' => '9V-SNA',
            'seat_capacity' => 180,
            'business_class_seats' => 8,
            'economy_class_seats' => 172,
            'max_speed' => 828,
            'range' => 6300,
            'manufacture_year' => 2020,
            'status' => 'active',
        ]);

        Plane::create([
            'airline_id' => $airasia->id,
            'model' => 'Boeing 777-300ER',
            'registration_number' => '9M-XXA',
            'seat_capacity' => 350,
            'business_class_seats' => 0,
            'economy_class_seats' => 350,
            'max_speed' => 905,
            'range' => 13650,
            'manufacture_year' => 2019,
            'status' => 'active',
        ]);
    }
}