<?php

namespace Database\Seeders;

use App\Models\Seat;
use App\Models\Flight;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus seats existing
        Seat::truncate();

        $flights = Flight::all();

        foreach ($flights as $flight) {
            $plane = $flight->plane;
            $businessSeats = $plane->business_class_seats;
            $economySeats = $plane->economy_class_seats;
            
            $seatCount = 0;
            
            Log::info("Creating seats for flight {$flight->flight_number}, Business: {$businessSeats}, Economy: {$economySeats}");

            // Business Class (Rows 1-2)
            for ($row = 1; $row <= 2; $row++) {
                $columns = ['A', 'B', 'C', 'D', 'E', 'F'];
                foreach ($columns as $col) {
                    if ($seatCount < $businessSeats) {
                        Seat::create([
                            'flight_id' => $flight->id,
                            'seat_number' => $row . $col,
                            'class' => 'business',
                            'is_emergency_exit' => false,
                            'is_booked' => false,
                            'price_multiplier' => 2.5,
                        ]);
                        $seatCount++;
                        Log::info("Created business seat: {$row}{$col}");
                    }
                }
            }
            
            // Economy Class (Rows 3-10)
            for ($row = 3; $row <= 10; $row++) {
                $columns = ['A', 'B', 'C', 'D', 'E', 'F'];
                foreach ($columns as $col) {
                    if ($seatCount < ($businessSeats + $economySeats)) {
                        $isEmergencyExit = ($row == 5 || $row == 6);
                        
                        Seat::create([
                            'flight_id' => $flight->id,
                            'seat_number' => $row . $col,
                            'class' => 'economy',
                            'is_emergency_exit' => $isEmergencyExit,
                            'is_booked' => false,
                            'price_multiplier' => $isEmergencyExit ? 1.2 : 1.0,
                        ]);
                        $seatCount++;
                        Log::info("Created economy seat: {$row}{$col}");
                    }
                }
            }

            Log::info("Total seats created for flight {$flight->flight_number}: {$seatCount}");
        }
    }
}