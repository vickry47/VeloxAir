@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Dashboard</h1>
    <p class="text-gray-600 mb-8">Selamat datang di panel admin VeloxAir</p>
    
    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                    <i class="fas fa-plane text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Penerbangan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_flights'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <i class="fas fa-ticket-alt text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Pemesanan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_bookings'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-purple-100 p-3 rounded-full mr-4">
                    <i class="fas fa-users text-purple-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Pengguna</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-yellow-100 p-3 rounded-full mr-4">
                    <i class="fas fa-money-bill-wave text-yellow-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Bookings -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Pemesanan Terbaru</h2>
                <a href="{{ route('admin.bookings') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                    Lihat semua
                </a>
            </div>
            
            <div class="space-y-4">
                @foreach($recent_bookings as $booking)
                <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">{{ $booking->passenger_name }}</p>
                            <p class="text-sm text-gray-600">{{ $booking->flight->flight_number }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $booking->flight->originAirport->code }} → {{ $booking->flight->destinationAirport->code }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : 
                                   ($booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                            <p class="text-sm text-gray-500 mt-1">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Quick Actions</h2>
            
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('admin.flights') }}" 
                   class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center hover:bg-blue-100 transition-colors">
                    <i class="fas fa-plane text-blue-600 text-2xl mb-2"></i>
                    <p class="font-medium text-blue-800">Kelola Penerbangan</p>
                </a>
                
                <a href="{{ route('admin.bookings') }}" 
                   class="bg-green-50 border border-green-200 rounded-lg p-4 text-center hover:bg-green-100 transition-colors">
                    <i class="fas fa-ticket-alt text-green-600 text-2xl mb-2"></i>
                    <p class="font-medium text-green-800">Kelola Pemesanan</p>
                </a>
                
                <a href="{{ route('admin.users') }}" 
                   class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center hover:bg-purple-100 transition-colors">
                    <i class="fas fa-users text-purple-600 text-2xl mb-2"></i>
                    <p class="font-medium text-purple-800">Kelola Pengguna</p>
                </a>
                
                <a href="{{ route('admin.flights.create') }}" 
                   class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center hover:bg-yellow-100 transition-colors">
                    <i class="fas fa-plus text-yellow-600 text-2xl mb-2"></i>
                    <p class="font-medium text-yellow-800">Tambah Penerbangan</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection