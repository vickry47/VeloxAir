@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pengguna - {{ $user->name }}</h1>
                <p class="text-gray-600">User ID: {{ $user->id }}</p>
            </div>
            <a href="{{ route('admin.users') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- User Profile -->
            <div class="bg-blue-50 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Profil</h2>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="h-12 w-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-lg">
                            {{ $user->avatar }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Role:</span>
                        <span class="px-2 py-1 rounded-full text-sm 
                            {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Telepon:</span>
                        <span class="font-medium">{{ $user->phone ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Terdaftar:</span>
                        <span class="font-medium">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Pemesanan:</span>
                        <span class="font-medium">{{ $user->bookings->count() }}x</span>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-green-50 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Statistik Pemesanan</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Pemesanan:</span>
                        <span class="font-medium">{{ $user->bookings->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Confirmed:</span>
                        <span class="font-medium text-green-600">
                            {{ $user->bookings->where('status', 'confirmed')->count() }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Pending:</span>
                        <span class="font-medium text-yellow-600">
                            {{ $user->bookings->where('status', 'pending')->count() }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Cancelled:</span>
                        <span class="font-medium text-red-600">
                            {{ $user->bookings->where('status', 'cancelled')->count() }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Pengeluaran:</span>
                        <span class="font-bold text-blue-600">
                            Rp {{ number_format($user->bookings->where('status', 'confirmed')->sum('total_price'), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-yellow-50 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
                <div class="space-y-2">
                    <!-- Tambahkan actions di sini jika diperlukan -->
                    <p class="text-sm text-gray-600 text-center py-4">
                        User management actions akan ditambahkan di Phase 2
                    </p>
                </div>
            </div>
        </div>

        <!-- Booking History -->
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Pemesanan</h2>
            
            @if($user->bookings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Penerbangan</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kursi</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($user->bookings as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-900">#{{ $booking->id }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900">
                                    {{ $booking->flight->flight_number }}
                                    <div class="text-xs text-gray-500">
                                        {{ $booking->flight->originAirport->code }} → {{ $booking->flight->destinationAirport->code }}
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-900">
                                    {{ $booking->seat_number }} ({{ $booking->seat_class }})
                                </td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : 
                                           ($booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-sm font-medium text-gray-900">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-500">
                                    {{ $booking->created_at->format('d M Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-ticket-alt text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Belum ada riwayat pemesanan</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection