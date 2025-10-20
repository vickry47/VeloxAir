<?php

namespace App\Http\Controllers;

use App\Models\Flight;

class FlightController extends Controller
{
    public function index()
    {
        // Ambil semua flight beserta relasinya
        $flights = Flight::with(['plane.airline'])->get();

        return view('flights.index', compact('flights'));
    }

    public function show(Flight $flight)
    {
        $flight->load('plane.airline'); // pastikan relasi ke maskapai & pesawat
        return view('flights.show', compact('flight'));
    }

}