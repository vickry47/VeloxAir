<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        // Pastikan invoice milik user yang login
        if ($invoice->payment->booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Load relasi untuk tampilan invoice
        $invoice->load(['payment.booking.flight.plane.airline', 'payment.booking.user']);

        return view('invoices.show', compact('invoice'));
    }
}