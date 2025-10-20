<?php

namespace Database\Seeders;

use App\Models\Plane;
use App\Models\Airline;
use Illuminate\Database\Seeder;

class PlaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $garuda = Airline::where('code', 'GA')->first();
        $sq = Airline::where('code', 'SQ')->first();
        $airasia = Airline::where('code', 'AK')->first();

        Plane::create([
            'airline_id' => $garuda->id,
            'model' => 'Boeing 737',
            'seat_capacity' => 30,
        ]);

        Plane::create([
            'airline_id' => $sq->id,
            'model' => 'Airbus A320',
            'seat_capacity' => 24,
        ]);

        Plane::create([
            'airline_id' => $airasia->id,
            'model' => 'Boeing 777',
            'seat_capacity' => 36,
        ]);
    }
}
