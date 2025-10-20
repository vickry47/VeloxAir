<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Airline::create(['name' => 'Garuda Indonesia', 'code' => 'GA']);
        Airline::create(['name' => 'Singapore Airlines', 'code' => 'SQ']);
        Airline::create(['name' => 'AirAsia', 'code' => 'AK']);
    }
}
