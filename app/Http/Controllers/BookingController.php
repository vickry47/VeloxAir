<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, Flight $flight)
    {
        $request->validate([
            'seat_number' => 'required|string|max:10',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'flight_id' => $flight->id,
            'seat_number' => $request->seat_number,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.index')->with('success', 'Pemesanan berhasil!');
    }
}
