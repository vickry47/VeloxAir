@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="bg-blue-600 text-white rounded-2xl p-8 mb-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Terbang Nyaman dengan VeloxAir</h1>
            <p class="text-xl mb-8">Temukan penerbangan terbaik ke destinasi impian Anda</p>
        </div>
        
        <!-- Search Form DIHAPUS -->
    </div>

    <!-- Flights List -->
    @if($flights->count() > 0)
        <div class="space-y-6">
            @foreach($flights as $flight)
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                        <div class="flex-1">
                            <!-- Airline Info -->
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <i class="fas fa-plane text-blue-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $flight->flight_number }}</h3>
                                    <p class="text-gray-600">{{ $flight->plane->airline->name }} • {{ $flight->plane->model }}</p>
                                </div>
                            </div>
                            
                            <!-- Flight Details -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                                <div>
                                    <p class="text-2xl font-bold text-gray-900">{{ $flight->formatted_departure_time }}</p>
                                    <p class="text-gray-600 font-medium">{{ $flight->originAirport->city }}</p>
                                    <p class="text-sm text-gray-500">{{ $flight->originAirport->name }} ({{ $flight->originAirport->code }})</p>
                                    <p class="text-sm text-gray-500">{{ $flight->formatted_departure_date }}</p>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-gray-500 mb-2">{{ $flight->duration }}</p>
                                    <div class="flex items-center justify-center my-2">
                                        <div class="w-16 h-px bg-gray-300"></div>
                                        <i class="fas fa-plane mx-3 text-gray-400 text-sm"></i>
                                        <div class="w-16 h-px bg-gray-300"></div>
                                    </div>
                                    <p class="text-sm text-gray-500">Langsung</p>
                                </div>
                                
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-gray-900">{{ $flight->formatted_arrival_time }}</p>
                                    <p class="text-gray-600 font-medium">{{ $flight->destinationAirport->city }}</p>
                                    <p class="text-sm text-gray-500">{{ $flight->destinationAirport->name }} ({{ $flight->destinationAirport->code }})</p>
                                    <p class="text-sm text-gray-500">{{ $flight->formatted_arrival_date }}</p>
                                </div>
                            </div>
                            
                            <!-- Flight Status -->
                            <div class="flex items-center space-x-4 text-sm">
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                    {{ $flight->available_seats }} kursi tersedia
                                </span>
                                <span class="text-gray-500">
                                    <i class="fas fa-chair mr-1"></i>{{ $flight->plane->seat_capacity }} total kursi
                                </span>
                            </div>
                        </div>
                        
                        <!-- Price & Action -->
                        <div class="mt-4 lg:mt-0 lg:ml-6 text-center lg:text-right">
                            <p class="text-3xl font-bold text-blue-600 mb-2">
                                Rp {{ number_format($flight->price_per_seat, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-600 mb-4">per orang</p>
                            <a href="{{ route('flights.show', $flight) }}" 
                               class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-eye mr-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($flights->hasPages())
        <div class="mt-8">
            <div class="flex justify-center items-center space-x-4">
                <!-- Previous Page Link -->
                @if($flights->onFirstPage())
                    <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                    </span>
                @else
                    <a href="{{ $flights->previousPageUrl() }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                    </a>
                @endif

                <!-- Page Numbers -->
                <div class="flex space-x-2">
                    @foreach(range(1, $flights->lastPage()) as $page)
                        @if($page == $flights->currentPage())
                            <span class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold">{{ $page }}</span>
                        @else
                            <a href="{{ $flights->url($page) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                <!-- Next Page Link -->
                @if($flights->hasMorePages())
                    <a href="{{ $flights->nextPageUrl() }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Selanjutnya<i class="fas fa-chevron-right ml-2"></i>
                    </a>
                @else
                    <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        Selanjutnya<i class="fas fa-chevron-right ml-2"></i>
                    </span>
                @endif
            </div>
            
            <!-- Page Info -->
            <div class="text-center mt-4 text-gray-600">
                Menampilkan {{ $flights->firstItem() ?? 0 }} - {{ $flights->lastItem() ?? 0 }} dari {{ $flights->total() }} penerbangan
            </div>
        </div>
        @endif
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-700 mb-2">Tidak ada penerbangan ditemukan</h3>
            <p class="text-gray-500 mb-6">Coba ubah kriteria pencarian Anda atau lihat semua penerbangan yang tersedia.</p>
            <a href="{{ route('flights.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                Lihat Semua Penerbangan
            </a>
        </div>
    @endif
</div>
@endsection