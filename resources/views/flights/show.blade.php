@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Flight Header -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $flight->flight_number }}</h1>
                <p class="text-gray-600">{{ $flight->plane->airline->name }} • {{ $flight->plane->model }}</p>
            </div>
            <div class="mt-4 lg:mt-0">
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                    Tersedia
                </span>
            </div>
        </div>
        
        <!-- Flight Route -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="text-center">
                <p class="text-3xl font-bold text-gray-900">{{ $flight->formatted_departure_time }}</p>
                <p class="text-lg font-medium text-gray-700">{{ $flight->originAirport->city }}</p>
                <p class="text-gray-500">{{ $flight->originAirport->name }} ({{ $flight->originAirport->code }})</p>
                <p class="text-sm text-gray-400">{{ $flight->formatted_departure_date }}</p>
            </div>
            
            <div class="text-center flex flex-col items-center justify-center">
                <p class="text-gray-500 mb-2">{{ $flight->duration }}</p>
                <div class="flex items-center w-full max-w-xs">
                    <div class="flex-1 h-px bg-gray-300"></div>
                    <i class="fas fa-plane mx-4 text-gray-400"></i>
                    <div class="flex-1 h-px bg-gray-300"></div>
                </div>
                <p class="text-sm text-gray-500 mt-2">Penerbangan langsung</p>
            </div>
            
            <div class="text-center">
                <p class="text-3xl font-bold text-gray-900">{{ $flight->formatted_arrival_time }}</p>
                <p class="text-lg font-medium text-gray-700">{{ $flight->destinationAirport->city }}</p>
                <p class="text-gray-500">{{ $flight->destinationAirport->name }} ({{ $flight->destinationAirport->code }})</p>
                <p class="text-sm text-gray-400">{{ $flight->formatted_arrival_date }}</p>
            </div>
        </div>
    </div>

    @auth
    <!-- Booking Form -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Pesan Tiket</h2>
        
        <form action="{{ route('bookings.store', $flight) }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Passenger Details -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Data Penumpang</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="passenger_name" required 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Nama lengkap penumpang" value="{{ old('passenger_name') }}">
                            @error('passenger_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="passenger_email" required 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Email penumpang" value="{{ old('passenger_email', auth()->user()->email) }}">
                            @error('passenger_email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="text" name="passenger_phone" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Nomor telepon penumpang" value="{{ old('passenger_phone', auth()->user()->phone) }}">
                            @error('passenger_phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Seat Selection -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Pilih Kursi</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                            <select name="seat_class" id="seatClass" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="economy">Economy Class</option>
                                <option value="business">Business Class</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Kursi</label>
                            <select name="seat_number" id="seatNumber" required
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Kursi</option>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                            @error('seat_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Price Summary -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between text-sm mb-2">
                                <span>Harga dasar:</span>
                                <span>Rp {{ number_format($flight->price_per_seat, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm mb-2">
                                <span>Multiplier kursi:</span>
                                <span id="seatMultiplier">1.0x</span>
                            </div>
                            <div class="flex justify-between font-semibold text-lg border-t pt-2">
                                <span>Total:</span>
                                <span id="totalPrice">Rp {{ number_format($flight->price_per_seat, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                    <i class="fas fa-ticket-alt mr-2"></i>Pesan Sekarang
                </button>
            </div>
        </form>
    </div>
    @else
    <!-- Login Prompt -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
        <i class="fas fa-exclamation-triangle text-yellow-500 text-3xl mb-4"></i>
        <h3 class="text-lg font-semibold text-yellow-800 mb-2">Login Diperlukan</h3>
        <p class="text-yellow-700 mb-4">Anda harus login untuk memesan tiket penerbangan ini.</p>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Login
            </a>
            <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                Daftar
            </a>
        </div>
    </div>
    @endauth

    <!-- Available Seats -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Kursi Tersedia</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Economy Class -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Economy Class</h3>
                <div class="grid grid-cols-4 gap-2">
                    @foreach($availableSeats['economy'] as $seat)
                        <div class="text-center p-2 border rounded-lg {{ $seat->is_emergency_exit ? 'bg-orange-100 border-orange-300' : 'bg-gray-50' }}">
                            <div class="font-mono text-sm">{{ $seat->seat_number }}</div>
                            <div class="text-xs text-gray-500">
                                {{ $seat->price_multiplier }}x
                                @if($seat->is_emergency_exit)
                                    <br><span class="text-orange-600">Emergency</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Business Class -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Business Class</h3>
                <div class="grid grid-cols-4 gap-2">
                    @foreach($availableSeats['business'] as $seat)
                        <div class="text-center p-2 border rounded-lg bg-blue-50 border-blue-200">
                            <div class="font-mono text-sm">{{ $seat->seat_number }}</div>
                            <div class="text-xs text-gray-500">{{ $seat->price_multiplier }}x</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Legend -->
        <div class="mt-6 flex flex-wrap gap-4 text-sm">
            <div class="flex items-center space-x-2">
                <div class="w-4 h-4 bg-gray-100 border border-gray-300 rounded"></div>
                <span>Economy Class</span>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-4 h-4 bg-blue-100 border border-blue-300 rounded"></div>
                <span>Business Class</span>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-4 h-4 bg-orange-100 border border-orange-300 rounded"></div>
                <span>Emergency Exit</span>
            </div>
        </div>
    </div>
</div>

{{-- ... kode sebelumnya tetap ... --}}

@auth
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== DEBUG JAVASCRIPT START ===');
        
        const seatClassSelect = document.getElementById('seatClass');
        const seatNumberSelect = document.getElementById('seatNumber');
        const basePrice = {{ $flight->price_per_seat }};
        
        // Data dari PHP - pastikan formatnya benar
        const economySeats = @json($availableSeats['economy']);
        const businessSeats = @json($availableSeats['business']);
        
        console.log('Base price:', basePrice);
        console.log('Economy seats:', economySeats);
        console.log('Business seats:', businessSeats);
        
        function updateSeatOptions() {
            const selectedClass = seatClassSelect.value;
            console.log('Class changed to:', selectedClass);
            
            // Clear existing options
            seatNumberSelect.innerHTML = '<option value="">Pilih Kursi</option>';
            
            let seats = [];
            if (selectedClass === 'economy') {
                seats = economySeats;
            } else if (selectedClass === 'business') {
                seats = businessSeats;
            }
            
            console.log('Seats for class:', seats);
            
            if (seats && seats.length > 0) {
                seats.forEach(seat => {
                    const option = document.createElement('option');
                    option.value = seat.seat_number;
                    option.textContent = `${seat.seat_number} (${seat.price_multiplier}x)`;
                    option.dataset.multiplier = seat.price_multiplier;
                    seatNumberSelect.appendChild(option);
                });
                console.log('Added ' + seats.length + ' seats to dropdown');
            } else {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'Tidak ada kursi tersedia';
                option.disabled = true;
                seatNumberSelect.appendChild(option);
                console.log('No seats available for this class');
            }
            
            updatePrice();
        }
        
        function updatePrice() {
            const selectedOption = seatNumberSelect.options[seatNumberSelect.selectedIndex];
            console.log('Seat selected:', selectedOption.value);
            
            if (selectedOption.value && selectedOption.dataset.multiplier) {
                const multiplier = parseFloat(selectedOption.dataset.multiplier);
                const totalPrice = basePrice * multiplier;
                
                document.getElementById('seatMultiplier').textContent = multiplier + 'x';
                document.getElementById('totalPrice').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
                console.log('Price updated:', totalPrice);
            } else {
                document.getElementById('seatMultiplier').textContent = '1.0x';
                document.getElementById('totalPrice').textContent = 'Rp ' + basePrice.toLocaleString('id-ID');
            }
        }
        
        // Event listeners
        seatClassSelect.addEventListener('change', updateSeatOptions);
        seatNumberSelect.addEventListener('change', updatePrice);
        
        // Initial load
        updateSeatOptions();
        
        console.log('=== DEBUG JAVASCRIPT END ===');
    });
</script>
@endauth
@endsection