<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Booking $booking)
    {
        // Authorization - hanya user yang punya booking yang bisa bayar
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Cek jika booking sudah paid
        if ($booking->status === 'confirmed') {
            return redirect()->route('bookings.show', $booking)
                           ->with('info', 'Booking ini sudah dibayar.');
        }

        $booking->load(['flight.plane.airline', 'flight.originAirport', 'flight.destinationAirport']);
        
        return view('payments.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Validasi payment method
        $request->validate([
            'payment_method' => 'required|in:credit_card,bank_transfer,e_wallet',
        ]);

        // Update status booking
        $booking->update([
            'status' => 'confirmed'
        ]);

        // Create payment record sesuai struktur migration
        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'method' => $request->payment_method, // sesuai field di migration
            'status' => 'paid' // sesuai enum di migration
        ]);

        return redirect()->route('bookings.show', $booking)
                       ->with('success', 'Pembayaran berhasil! Tiket Anda telah dikonfirmasi.');
    }
}