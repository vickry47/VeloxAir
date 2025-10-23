@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Booking Header -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pemesanan</h1>
                <p class="text-gray-600">Booking ID: {{ $booking->id }}</p>
            </div>
            <div class="text-right">
                <span class="px-3 py-1 rounded-full text-sm font-medium 
                    {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : 
                       ($booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                       'bg-red-100 text-red-800') }}">
                    {{ ucfirst($booking->status) }}
                </span>
                <p class="text-sm text-gray-500 mt-1">{{ $booking->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <!-- Flight Details -->
        <div class="border-t pt-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Penerbangan</h2>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="bg-blue-100 p-2 rounded-full">
                        <i class="fas fa-plane text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $booking->flight->flight_number }}</h3>
                        <p class="text-gray-600">{{ $booking->flight->plane->airline->name }} • {{ $booking->flight->plane->model }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center">
                        <p class="text-xl font-bold text-gray-900">{{ $booking->flight->formatted_departure_time }}</p>
                        <p class="text-gray-700">{{ $booking->flight->originAirport->city }}</p>
                        <p class="text-sm text-gray-500">{{ $booking->flight->originAirport->name }}</p>
                        <p class="text-sm text-gray-400">{{ $booking->flight->formatted_departure_date }}</p>
                    </div>
                    
                    <div class="text-center flex flex-col items-center justify-center">
                        <p class="text-gray-500 text-sm">{{ $booking->flight->duration }}</p>
                        <div class="flex items-center w-full my-2">
                            <div class="flex-1 h-px bg-gray-300"></div>
                            <i class="fas fa-plane mx-2 text-gray-400 text-sm"></i>
                            <div class="flex-1 h-px bg-gray-300"></div>
                        </div>
                        <p class="text-xs text-gray-500">Langsung</p>
                    </div>
                    
                    <div class="text-center">
                        <p class="text-xl font-bold text-gray-900">{{ $booking->flight->formatted_arrival_time }}</p>
                        <p class="text-gray-700">{{ $booking->flight->destinationAirport->city }}</p>
                        <p class="text-sm text-gray-500">{{ $booking->flight->destinationAirport->name }}</p>
                        <p class="text-sm text-gray-400">{{ $booking->flight->formatted_arrival_date }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Passenger & Booking Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Passenger Information -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Penumpang</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Nama Lengkap</p>
                    <p class="font-medium text-gray-800">{{ $booking->passenger_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-800">{{ $booking->passenger_email }}</p>
                </div>
                @if($booking->passenger_phone)
                <div>
                    <p class="text-sm text-gray-500">Telepon</p>
                    <p class="font-medium text-gray-800">{{ $booking->passenger_phone }}</p>
                </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500">Kelas</p>
                    <p class="font-medium text-gray-800 capitalize">{{ $booking->seat_class }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kursi</p>
                    <p class="font-medium text-gray-800">{{ $booking->seat_number }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pembayaran</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Harga</span>
                    <span class="text-2xl font-bold text-blue-600">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </span>
                </div>
                
                @if($booking->payment)
                <div class="border-t pt-4 space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status Pembayaran</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">
                            {{ ucfirst($booking->payment->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Metode</span>
                        <span class="font-medium text-gray-800 capitalize">
                            {{ str_replace('_', ' ', $booking->payment->method) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal Bayar</span>
                        <span class="font-medium text-gray-800">
                            {{ $booking->payment->created_at->format('d M Y H:i') }}
                        </span>
                    </div>
                    
                    @if($booking->payment->invoice)
                    <div class="pt-2">
                        <a href="{{ route('invoices.show', $booking->payment->invoice) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-700">
                            <i class="fas fa-file-invoice mr-2"></i>
                            Lihat Invoice
                        </a>
                    </div>
                    @endif
                </div>
                @else
                <div class="text-center py-4">
                    <p class="text-gray-500 mb-4">Menunggu pembayaran</p>
                    <a href="{{ route('payments.create', $booking) }}" 
                       class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-credit-card mr-2"></i>Bayar Sekarang
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <div>
                <p class="text-gray-600">Butuh bantuan?</p>
                <p class="font-medium text-gray-800">Hubungi VeloxAir Support</p>
            </div>
            
            <div class="flex space-x-4">
                <a href="{{ route('bookings.index') }}" 
                   class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                
                @if($booking->status == 'pending')
                <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors"
                            onclick="return confirm('Yakin ingin membatalkan pemesanan?')">
                        <i class="fas fa-times mr-2"></i>Batalkan
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection