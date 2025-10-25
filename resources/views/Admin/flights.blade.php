@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Penerbangan</h1>
        <a href="{{ route('admin.flights.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Tambah Penerbangan
        </a>
    </div>

    @if($flights->count() > 0)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerbangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rute</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kursi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($flights as $flight)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $flight->flight_number }}</div>
                                <div class="text-sm text-gray-500">{{ $flight->plane->airline->name }}</div>
                                <div class="text-sm text-gray-500">{{ $flight->plane->model }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $flight->originAirport->code }} → {{ $flight->destinationAirport->code }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $flight->originAirport->city }} → {{ $flight->destinationAirport->city }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $flight->departure_time->format('d M Y H:i') }}</div>
                                <div class="text-sm text-gray-500">{{ $flight->duration }} menit</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $flight->available_seats }} / {{ $flight->plane->seat_capacity }}</div>
                                <div class="text-sm text-gray-500">Tersedia</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $flight->status == 'active' ? 'bg-green-100 text-green-800' : 
                                       ($flight->status == 'scheduled' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($flight->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($flight->price_per_seat, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.flights.edit', $flight) }}" 
                                class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <i class="fas fa-plane text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-700 mb-2">Belum ada penerbangan</h3>
            <p class="text-gray-500 mb-6">Mulai tambahkan penerbangan pertama Anda.</p>
            <a href="{{ route('admin.flights.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                Tambah Penerbangan
            </a>
        </div>
    @endif
</div>
@endsection