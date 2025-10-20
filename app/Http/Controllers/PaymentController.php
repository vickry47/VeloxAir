<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('flight', 'payment')
            ->where('user_id', auth()->id())
            ->get();

        return view('booking.index', compact('bookings'));
    }

    // Menampilkan form pembayaran
    public function showPaymentForm(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.form', compact('booking'));
    }

    // Memproses pembayaran
    public function pay(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'method' => 'required|string|max:50',
        ]);

        // Update status booking menjadi confirmed
        $booking->update(['status' => 'confirmed']);

        // Create atau update payment
        $payment = Payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'amount' => $booking->flight->price_per_seat,
                'method' => $request->method,
                'status' => 'paid',
            ]
        );

        // Create invoice jika belum ada
        if (!$payment->invoice) {
            $invoice = Invoice::create([
                'payment_id' => $payment->id,
                'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                'invoice_date' => now(),
            ]);

            $payment->setRelation('invoice', $invoice);
        }

        return redirect()->route('invoices.show', $payment->invoice->id)
                         ->with('success', 'Pembayaran berhasil! Invoice sudah dibuat.');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'canceled']);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibatalkan.');
    }
}