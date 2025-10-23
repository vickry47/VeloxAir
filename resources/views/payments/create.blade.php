@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pembayaran Tiket</h1>
        
        <!-- Booking Summary -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Ringkasan Pemesanan</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Penerbangan</span>
                    <span class="font-medium">{{ $booking->flight->flight_number }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Rute</span>
                    <span class="font-medium">
                        {{ $booking->flight->originAirport->code }} → {{ $booking->flight->destinationAirport->code }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Penumpang</span>
                    <span class="font-medium">{{ $booking->passenger_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Kursi</span>
                    <span class="font-medium">{{ $booking->seat_number }} ({{ $booking->seat_class }})</span>
                </div>
                <div class="flex justify-between border-t pt-2">
                    <span class="text-gray-600 font-semibold">Total</span>
                    <span class="text-lg font-bold text-blue-600">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <form action="{{ route('payments.store', $booking) }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Pilih Metode Pembayaran</h2>
                
                <div class="space-y-3">
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="payment_method" value="credit_card" class="text-blue-600" checked>
                        <div class="ml-3">
                            <span class="font-medium text-gray-800">Kartu Kredit</span>
                            <p class="text-sm text-gray-500">Visa, MasterCard, JCB</p>
                        </div>
                        <div class="ml-auto flex space-x-2">
                            <i class="fab fa-cc-visa text-blue-600 text-xl"></i>
                            <i class="fab fa-cc-mastercard text-red-600 text-xl"></i>
                            <i class="fab fa-cc-jcb text-green-600 text-xl"></i>
                        </div>
                    </label>
                    
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="payment_method" value="bank_transfer" class="text-blue-600">
                        <div class="ml-3">
                            <span class="font-medium text-gray-800">Transfer Bank</span>
                            <p class="text-sm text-gray-500">BCA, Mandiri, BNI, BRI</p>
                        </div>
                        <div class="ml-auto flex space-x-2">
                            <i class="fas fa-university text-gray-600 text-xl"></i>
                        </div>
                    </label>
                    
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="payment_method" value="e_wallet" class="text-blue-600">
                        <div class="ml-3">
                            <span class="font-medium text-gray-800">E-Wallet</span>
                            <p class="text-sm text-gray-500">Gopay, OVO, Dana, LinkAja</p>
                        </div>
                        <div class="ml-auto flex space-x-2">
                            <i class="fas fa-wallet text-yellow-600 text-xl"></i>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Payment Details (Simulated) -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-yellow-500 mt-1 mr-3"></i>
                    <div>
                        <p class="text-yellow-800 font-medium">Simulasi Pembayaran</p>
                        <p class="text-yellow-700 text-sm mt-1">
                            Ini adalah simulasi pembayaran. Tidak ada transaksi uang sungguhan yang terjadi.
                            Klik "Bayar Sekarang" untuk menyelesaikan pemesanan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('bookings.show', $booking) }}" 
                   class="text-gray-600 hover:text-gray-800 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                
                <button type="submit" 
                        class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold">
                    <i class="fas fa-credit-card mr-2"></i>Bayar Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection