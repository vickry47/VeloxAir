<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Booking;
use App\Models\User;
use App\Models\Plane;
use App\Models\Airport;
use App\Models\Airline;
use App\Models\Seat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Method untuk check admin authorization
    private function checkAdmin()
    {
        if (!Auth::check()) {
            abort(403, 'Anda harus login terlebih dahulu.');
        }
        
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }
    }

    public function dashboard()
    {
        $this->checkAdmin();

        $stats = [
            'total_flights' => Flight::count(),
            'total_bookings' => Booking::count(),
            'total_users' => User::count(),
            'revenue' => Booking::where('status', 'confirmed')->sum('total_price'),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'active_flights' => Flight::where('status', 'active')->count(),
        ];

        $recent_bookings = Booking::with(['user', 'flight'])
            ->latest()
            ->limit(10)
            ->get();

        $upcoming_flights = Flight::with(['originAirport', 'destinationAirport'])
            ->where('departure_time', '>', now())
            ->orderBy('departure_time')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings', 'upcoming_flights'));
    }

    public function flights()
    {
        $this->checkAdmin();

        $flights = Flight::with(['plane.airline', 'originAirport', 'destinationAirport'])
            ->latest()
            ->get();
            
        return view('admin.flights', compact('flights'));
    }

    public function bookings()
    {
        $this->checkAdmin();

        $bookings = Booking::with(['user', 'flight.plane.airline'])
            ->latest()
            ->get();
            
        return view('admin.bookings', compact('bookings'));
    }

    public function users()
    {
        $this->checkAdmin();

        $users = User::withCount('bookings')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function createFlight()
    {
        $this->checkAdmin();

        $planes = Plane::with('airline')->where('status', 'active')->get();
        $airports = Airport::all();
        $airlines = Airline::all();

        return view('admin.create-flight', compact('planes', 'airports', 'airlines'));
    }

    public function storeFlight(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'origin_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|different:origin_airport_id|exists:airports,id',
            'flight_number' => 'required|unique:flights',
            'departure_time' => 'required|date|after:now',
            'arrival_time' => 'required|date|after:departure_time',
            'price_per_seat' => 'required|numeric|min:0'
        ]);

        // Calculate duration
        $departure = Carbon::parse($request->departure_time);
        $arrival = Carbon::parse($request->arrival_time);
        $duration = $departure->diffInMinutes($arrival);

        $plane = Plane::findOrFail($request->plane_id);

        $flight = Flight::create([
            'plane_id' => $request->plane_id,
            'origin_airport_id' => $request->origin_airport_id,
            'destination_airport_id' => $request->destination_airport_id,
            'flight_number' => $request->flight_number,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'duration_minutes' => $duration,
            'price_per_seat' => $request->price_per_seat,
            'available_seats' => $plane->seat_capacity,
            'status' => 'active'
        ]);

        // Create seats
        $this->createSeatsForFlight($flight, $plane);

        return redirect()->route('admin.flights')
                        ->with('success', 'Penerbangan berhasil ditambahkan!');
    }

    // ==================== PHASE 1 METHODS ====================

    public function editFlight(Flight $flight)
    {
        $this->checkAdmin();
        
        $planes = Plane::with('airline')->where('status', 'active')->get();
        $airports = Airport::all();
        
        return view('admin.edit-flight', compact('flight', 'planes', 'airports'));
    }

    public function updateFlight(Request $request, Flight $flight)
    {
        $this->checkAdmin();
        
        $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'origin_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|different:origin_airport_id|exists:airports,id',
            'flight_number' => 'required|unique:flights,flight_number,' . $flight->id,
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price_per_seat' => 'required|numeric|min:0',
            'status' => 'required|in:active,scheduled,cancelled,completed'
        ]);

        // Calculate duration
        $departure = Carbon::parse($request->departure_time);
        $arrival = Carbon::parse($request->arrival_time);
        $duration = $departure->diffInMinutes($arrival);

        $flight->update([
            'plane_id' => $request->plane_id,
            'origin_airport_id' => $request->origin_airport_id,
            'destination_airport_id' => $request->destination_airport_id,
            'flight_number' => $request->flight_number,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'duration_minutes' => $duration,
            'price_per_seat' => $request->price_per_seat,
            'status' => $request->status
        ]);

        return redirect()->route('admin.flights')
                        ->with('success', 'Penerbangan berhasil diupdate!');
    }

    public function showBooking(Booking $booking)
    {
        $this->checkAdmin();
        
        $booking->load(['user', 'flight.plane.airline', 'flight.originAirport', 'flight.destinationAirport', 'payment.invoice']);
        
        return view('admin.booking-detail', compact('booking'));
    }

    public function updateBooking(Request $request, Booking $booking)
    {
        $this->checkAdmin();
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $oldStatus = $booking->status;
        $booking->update(['status' => $request->status]);

        // Jika status berubah dari confirmed ke cancelled, kembalikan kursi
        if ($oldStatus === 'confirmed' && $request->status === 'cancelled') {
            $seat = Seat::where('flight_id', $booking->flight_id)
                       ->where('seat_number', $booking->seat_number)
                       ->first();
            if ($seat) {
                $seat->update(['is_booked' => false]);
            }
            $booking->flight->increment('available_seats');
        }

        // Jika status berubah ke confirmed, kurangi kursi tersedia
        if ($oldStatus !== 'confirmed' && $request->status === 'confirmed') {
            $seat = Seat::where('flight_id', $booking->flight_id)
                       ->where('seat_number', $booking->seat_number)
                       ->first();
            if ($seat) {
                $seat->update(['is_booked' => true]);
            }
            $booking->flight->decrement('available_seats');
        }

        return redirect()->route('admin.bookings.show', $booking)
                        ->with('success', 'Status pemesanan berhasil diupdate!');
    }

    public function showUser(User $user)
    {
        $this->checkAdmin();
        
        $user->load(['bookings.flight.plane.airline', 'bookings.flight.originAirport', 'bookings.flight.destinationAirport']);
        
        return view('admin.user-detail', compact('user'));
    }

    // ==================== HELPER METHODS ====================

    private function createSeatsForFlight(Flight $flight, Plane $plane)
    {
        $seats = [];
        
        // Business class
        $businessCount = 0;
        for ($row = 1; $row <= 2; $row++) {
            $columns = ['A', 'B', 'C', 'D', 'E', 'F'];
            foreach ($columns as $col) {
                if ($businessCount < $plane->business_class_seats) {
                    $seats[] = [
                        'flight_id' => $flight->id,
                        'seat_number' => $row . $col,
                        'class' => 'business',
                        'is_emergency_exit' => false,
                        'is_booked' => false,
                        'price_multiplier' => 2.5,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    $businessCount++;
                }
            }
        }
        
        // Economy class
        $economyCount = 0;
        for ($row = 3; $row <= 10; $row++) {
            $columns = ['A', 'B', 'C', 'D', 'E', 'F'];
            foreach ($columns as $col) {
                if ($economyCount < $plane->economy_class_seats) {
                    $isEmergencyExit = ($row == 5 || $row == 6);
                    
                    $seats[] = [
                        'flight_id' => $flight->id,
                        'seat_number' => $row . $col,
                        'class' => 'economy',
                        'is_emergency_exit' => $isEmergencyExit,
                        'is_booked' => false,
                        'price_multiplier' => $isEmergencyExit ? 1.2 : 1.0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    $economyCount++;
                }
            }
        }
        
        Seat::insert($seats);
    }
}