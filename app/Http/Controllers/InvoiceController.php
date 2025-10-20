<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        // Pastikan invoice milik user yang login
        if ($invoice->payment->booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('invoices.show', compact('invoice'));
    }
}
