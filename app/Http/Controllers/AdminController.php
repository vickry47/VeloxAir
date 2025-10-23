<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Booking;
use App\Models\User;
use App\Models\Plane;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403);
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $stats = [
            'total_flights' => Flight::count(),
            'total_bookings' => Booking::count(),
            'total_users' => User::count(),
            'revenue' => Booking::where('status', 'confirmed')->sum('total_price'),
        ];

        $recent_bookings = Booking::with(['user', 'flight'])
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings'));
    }

    public function flights()
    {
        $flights = Flight::with(['plane.airline', 'originAirport', 'destinationAirport'])
            ->latest()
            ->get();
            
        return view('admin.flights.index', compact('flights'));
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'flight.plane.airline'])
            ->latest()
            ->get();
            
        return view('admin.bookings.index', compact('bookings'));
    }
}