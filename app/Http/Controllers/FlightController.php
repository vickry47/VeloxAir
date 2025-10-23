<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Airport;
use App\Models\Seat;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::with(['originAirport', 'destinationAirport', 'plane.airline']);
        
        // Filter pencarian
        if ($request->filled('origin')) {
            $query->whereHas('originAirport', function($q) use ($request) {
                $q->where('code', 'like', '%' . $request->origin . '%')
                  ->orWhere('city', 'like', '%' . $request->origin . '%');
            });
        }
        
        if ($request->filled('destination')) {
            $query->whereHas('destinationAirport', function($q) use ($request) {
                $q->where('code', 'like', '%' . $request->destination . '%')
                  ->orWhere('city', 'like', '%' . $request->destination . '%');
            });
        }
        
        if ($request->filled('departure_date')) {
            $query->whereDate('departure_time', $request->departure_date);
        }
        
        // GUNAKAN PAGINATE() bukan get()
        $flights = $query->active()
                        ->upcoming()
                        ->orderBy('departure_time')
                        ->paginate(10); // ← INI YANG DIPERBAIKI
        
        $airports = Airport::all();
        
        return view('flights.index', compact('flights', 'airports'));
    }

   public function show(Flight $flight)
    {
        $flight->load(['originAirport', 'destinationAirport', 'plane.airline']);
        
        // Get available seats grouped by class
        $availableSeats = [
            'economy' => \App\Models\Seat::where('flight_id', $flight->id)
                            ->where('is_booked', false)
                            ->where('class', 'economy')
                            ->get(),
            'business' => \App\Models\Seat::where('flight_id', $flight->id)
                            ->where('is_booked', false)
                            ->where('class', 'business')
                            ->get()
        ];

        // DEBUG: Tampilkan data yang dikirim ke view
        \Log::info("=== DEBUG FLIGHT SHOW ===");
        \Log::info("Economy seats count: " . $availableSeats['economy']->count());
        \Log::info("Business seats count: " . $availableSeats['business']->count());
        \Log::info("Economy seats sample: " . $availableSeats['economy']->take(3)->pluck('seat_number'));
        \Log::info("Business seats sample: " . $availableSeats['business']->take(3)->pluck('seat_number'));

        return view('flights.show', compact('flight', 'availableSeats'));
    }
}