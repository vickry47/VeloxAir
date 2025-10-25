@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Penerbangan - {{ $flight->flight_number }}</h1>
            <a href="{{ route('admin.flights') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <form action="{{ route('admin.flights.update', $flight) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Flight Basic Info -->
                <div class="md:col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Informasi Penerbangan</h2>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Penerbangan *</label>
                    <input type="text" name="flight_number" required 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           value="{{ old('flight_number', $flight->flight_number) }}">
                    @error('flight_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" required 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="active" {{ old('status', $flight->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="scheduled" {{ old('status', $flight->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="cancelled" {{ old('status', $flight->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ old('status', $flight->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pesawat *</label>
                    <select name="plane_id" required 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Pesawat</option>
                        @foreach($planes as $plane)
                            <option value="{{ $plane->id }}" {{ old('plane_id', $flight->plane_id) == $plane->id ? 'selected' : '' }}>
                                {{ $plane->airline->name }} - {{ $plane->model }} ({{ $plane->registration_number }})
                            </option>
                        @endforeach
                    </select>
                    @error('plane_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Route Information -->
                <div class="md:col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Rute Penerbangan</h2>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bandara Keberangkatan *</label>
                    <select name="origin_airport_id" required 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Bandara Asal</option>
                        @foreach($airports as $airport)
                            <option value="{{ $airport->id }}" {{ old('origin_airport_id', $flight->origin_airport_id) == $airport->id ? 'selected' : '' }}>
                                {{ $airport->code }} - {{ $airport->city }}
                            </option>
                        @endforeach
                    </select>
                    @error('origin_airport_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bandara Tujuan *</label>
                    <select name="destination_airport_id" required 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Bandara Tujuan</option>
                        @foreach($airports as $airport)
                            <option value="{{ $airport->id }}" {{ old('destination_airport_id', $flight->destination_airport_id) == $airport->id ? 'selected' : '' }}>
                                {{ $airport->code }} - {{ $airport->city }}
                            </option>
                        @endforeach
                    </select>
                    @error('destination_airport_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Schedule Information -->
                <div class="md:col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Jadwal Penerbangan</h2>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Keberangkatan *</label>
                    <input type="datetime-local" name="departure_time" required 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           value="{{ old('departure_time', $flight->departure_time->format('Y-m-d\TH:i')) }}">
                    @error('departure_time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Kedatangan *</label>
                    <input type="datetime-local" name="arrival_time" required 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           value="{{ old('arrival_time', $flight->arrival_time->format('Y-m-d\TH:i')) }}">
                    @error('arrival_time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pricing -->
                <div class="md:col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Harga</h2>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Kursi (Economy) *</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                        </div>
                        <input type="number" name="price_per_seat" required min="0" step="1000"
                               class="block w-full pl-12 pr-12 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('price_per_seat', $flight->price_per_seat) }}">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">,00</span>
                        </div>
                    </div>
                    @error('price_per_seat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Flight Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <h3 class="text-lg font-semibold text-blue-700 mb-2">Informasi Saat Ini</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-blue-600">Durasi:</span> 
                        <span class="font-medium">{{ $flight->duration }} menit</span>
                    </div>
                    <div>
                        <span class="text-blue-600">Kursi Tersedia:</span> 
                        <span class="font-medium">{{ $flight->available_seats }} / {{ $flight->plane->seat_capacity }}</span>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.flights') }}" 
                   class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                    <i class="fas fa-save mr-2"></i>Update Penerbangan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const departureInput = document.querySelector('input[name="departure_time"]');
    const arrivalInput = document.querySelector('input[name="arrival_time"]');
    
    // DateTime handlers for duration calculation
    departureInput.addEventListener('change', calculateDuration);
    arrivalInput.addEventListener('change', calculateDuration);

    function calculateDuration() {
        const departure = new Date(departureInput.value);
        const arrival = new Date(arrivalInput.value);
        
        if (departure && arrival && arrival > departure) {
            const diffMs = arrival - departure;
            const diffMins = Math.floor(diffMs / 60000);
            const hours = Math.floor(diffMins / 60);
            const minutes = diffMins % 60;
            
            // Update duration display jika ada
            const durationElement = document.querySelector('[class*="text-blue-600"]');
            if (durationElement) {
                durationElement.textContent = hours + 'j ' + minutes + 'm';
            }
        }
    }
});
</script>
@endsection