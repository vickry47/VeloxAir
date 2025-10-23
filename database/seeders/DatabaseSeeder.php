<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class, 
            AirportSeeder::class,
            AirlineSeeder::class,
            PlaneSeeder::class,
            FlightSeeder::class,
            SeatSeeder::class,
        ]);
    }
}