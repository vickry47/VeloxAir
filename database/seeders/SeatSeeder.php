<?php

namespace Database\Seeders;

use App\Models\Seat;
use App\Models\Flight;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flights = Flight::all();

        foreach ($flights as $flight) {
            // Generate kursi dari A1 sampai F5 (6 kolom × 5 baris = 30 kursi)
            $rows = ['A', 'B', 'C', 'D', 'E', 'F'];
            for ($i = 1; $i <= 5; $i++) {
                foreach ($rows as $row) {
                    Seat::create([
                        'flight_id' => $flight->id,
                        'seat_number' => $row . $i,
                        'is_booked' => false,
                    ]);
                }
            }
        }
    }
}
