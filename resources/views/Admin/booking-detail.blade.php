@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pemesanan #{{ $booking->id }}</h1>
                <p class="text-gray-600">Booking ID: {{ $booking->id }}</p>
            </div>
            <a href="{{ route('admin.bookings') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <!-- Booking Status Update -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="flex items-center space-x-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                    <select name="status" class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors mt-6">
                    Update Status
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Flight Information -->
            <div class="bg-blue-50 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Penerbangan</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Penerbangan:</span>
                        <span class="font-medium">{{ $booking->flight->flight_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Maskapai:</span>
                        <span class="font-medium">{{ $booking->flight->plane->airline->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Rute:</span>
                        <span class="font-medium">{{ $booking->flight->originAirport->code }} → {{ $booking->flight->destinationAirport->code }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Keberangkatan:</span>
                        <span class="font-medium">{{ $booking->flight->departure_time->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kedatangan:</span>
                        <span class="font-medium">{{ $booking->flight->arrival_time->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kursi:</span>
                        <span class="font-medium">{{ $booking->seat_number }} ({{ $booking->seat_class }})</span>
                    </div>
                </div>
            </div>

            <!-- Passenger Information -->
            <div class="bg-green-50 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Penumpang</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nama:</span>
                        <span class="font-medium">{{ $booking->passenger_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email:</span>
                        <span class="font-medium">{{ $booking->passenger_email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Telepon:</span>
                        <span class="font-medium">{{ $booking->passenger_phone ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">User Account:</span>
                        <span class="font-medium">{{ $booking->user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">User Email:</span>
                        <span class="font-medium">{{ $booking->user->email }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-yellow-50 rounded-lg p-4 lg:col-span-2">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pembayaran</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Harga:</span>
                            <span class="text-lg font-bold text-blue-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status Booking:</span>
                            <span class="px-2 py-1 rounded-full text-sm 
                                {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : 
                                   ($booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        @if($booking->payment)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status Pembayaran:</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">
                                    {{ ucfirst($booking->payment->status) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Metode:</span>
                                <span class="font-medium capitalize">{{ $booking->payment->method }}</span>
                            </div>
                            @if($booking->payment->invoice)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Invoice:</span>
                                    <span class="font-medium">{{ $booking->payment->invoice->invoice_number }}</span>
                                </div>
                            @endif
                        @else
                            <div class="text-center text-gray-500 py-4">
                                <i class="fas fa-clock text-2xl mb-2"></i>
                                <p>Menunggu Pembayaran</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="mt-6 bg-gray-50 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Timeline</h2>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Dibuat:</span>
                    <span class="font-medium">{{ $booking->created_at->format('d M Y H:i') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Terakhir Update:</span>
                    <span class="font-medium">{{ $booking->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection