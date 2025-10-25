<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ==================== PUBLIC ROUTES ====================

// Homepage & Flight Search
Route::get('/', [FlightController::class, 'index'])->name('home');
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flights/{flight}', [FlightController::class, 'show'])->name('flights.show');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== AUTHENTICATED USER ROUTES ====================

Route::middleware(['auth'])->group(function () {
    
    // Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/bookings', [UserController::class, 'bookingHistory'])->name('profile.bookings');

    // Bookings - FIXED ORDER
    Route::post('/bookings/{flight}', [BookingController::class, 'store'])->name('bookings.store'); // HARUS DULUAN
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Payments - FIXED METHOD NAMES
    Route::get('/payments/{booking}/create', [PaymentController::class, 'create'])->name('payments.create'); // create() bukan showPaymentForm()
    Route::post('/payments/{booking}', [PaymentController::class, 'store'])->name('payments.store'); // store() bukan pay()

    // Invoices
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
});

// ==================== ADMIN ROUTES ====================

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/flights', [AdminController::class, 'flights'])->name('admin.flights');
    Route::get('/flights/create', [AdminController::class, 'createFlight'])->name('admin.flights.create');
    Route::post('/flights', [AdminController::class, 'storeFlight'])->name('admin.flights.store');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});