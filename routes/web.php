<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Redirect root ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// =======================
// 🔐 Auth Routes
// =======================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// 🔒 Routes with Auth Middleware
// =======================
Route::middleware('auth')->group(function () {
    
    // ✈️ Flights
    Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
    Route::get('/flights/{flight}', [FlightController::class, 'show'])->name('flights.show');

    // 🧾 Booking pesawat
    Route::post('/flights/{flight}/book', [BookingController::class, 'store'])->name('bookings.store');

    // 🧍 Riwayat Booking dan Aksi
    Route::get('/my-bookings', [PaymentController::class, 'index'])->name('bookings.index');

    // 💳 Halaman Form Pembayaran (GET)
    Route::get('/bookings/{booking}/pay', [PaymentController::class, 'showPaymentForm'])->name('bookings.payment.form');

    // 💳 Proses Pembayaran (POST)
    Route::post('/bookings/{booking}/pay', [PaymentController::class, 'pay'])->name('bookings.pay');

    // ❌ Batalkan booking
    Route::post('/bookings/{booking}/cancel', [PaymentController::class, 'cancel'])->name('bookings.cancel');

    // 📄 Invoice
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
});
