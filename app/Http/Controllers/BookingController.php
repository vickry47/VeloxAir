<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Booking;
use App\Models\Seat;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() 
{
    // Kirim data flights bukan bookings
    $flights = Flight::with(['plane.airline', 'originAirport', 'destinationAirport'])
                     ->where('departure_time', '>', now())
                     ->where('available_seats', '>', 0)
                     ->orderBy('departure_time', 'asc')
                     ->paginate(10);

    return view('bookings.index', compact('flights'));
}
    public function store(Request $request, Flight $flight)
    {
        $request->validate([
            'seat_number' => 'required|string|max:10',
            'passenger_name' => 'required|string|max:255',
            'passenger_email' => 'required|email',
            'passenger_phone' => 'nullable|string|max:20',
        ]);

        // Validasi kursi tersedia
        $seat = Seat::where('flight_id', $flight->id)
                   ->where('seat_number', $request->seat_number)
                   ->where('is_booked', false)
                   ->first();

        if (!$seat) {
            return back()->withErrors(['seat_number' => 'Kursi tidak tersedia atau sudah dipesan.']);
        }

        // Create booking dengan data lengkap
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'flight_id' => $flight->id,
            'seat_number' => $request->seat_number,
            'passenger_name' => $request->passenger_name,
            'passenger_email' => $request->passenger_email,
            'passenger_phone' => $request->passenger_phone,
            'seat_class' => $seat->class,
            'total_price' => $flight->price_per_seat * $seat->price_multiplier, 
            'status' => 'pending'
        ]);

        // Update status kursi
        $seat->update(['is_booked' => true]);

        // Kurangi kursi tersedia
        $flight->decreaseAvailableSeats(1);

        // Redirect ke payment page
        return redirect()->route('payments.create', $booking);
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->load(['flight.plane.airline', 'flight.originAirport', 'flight.destinationAirport']);
        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return redirect()->route('bookings.index')->with('error', 'Booking tidak dapat dibatalkan.');
        }

        $booking->update(['status' => 'cancelled']);

        // Free up the seat
        $seat = $booking->flight->seats()->where('seat_number', $booking->seat_number)->first();
        if ($seat) {
            $seat->update(['is_booked' => false]);
        }

        // Increase available seats
        $booking->flight->increaseAvailableSeats(1);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibatalkan.');
    }
}   