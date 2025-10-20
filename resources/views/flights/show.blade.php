<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket - SkyWings Airlines</title>
    <style>
        :root {
            --primary: #1a73e8;
            --primary-dark: #0d47a1;
            --secondary: #f57c00;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #28a745;
            --danger: #dc3545;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border: #dee2e6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h1 {
            color: var(--dark);
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            color: var(--gray);
            font-size: 1.1rem;
        }

        .booking-container {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        /* Flight Details Card */
        .flight-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .flight-card h2 {
            color: var(--dark);
            margin-bottom: 25px;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flight-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .airline-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .airline-logo {
            width: 60px;
            height: 60px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .airline-details h3 {
            color: var(--dark);
            font-size: 1.3rem;
            margin-bottom: 5px;
        }

        .airline-details p {
            color: var(--gray);
        }

        .flight-price {
            text-align: right;
        }

        .price-amount {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .price-label {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .flight-route {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--light);
            border-radius: 10px;
        }

        .route-section {
            text-align: center;
        }

        .route-city {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .route-time {
            font-size: 1.2rem;
            color: var(--gray);
            margin-bottom: 5px;
        }

        .route-date {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .route-divider {
            text-align: center;
            color: var(--primary);
            font-size: 2rem;
            font-weight: bold;
        }

        .flight-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .detail-item {
            padding: 15px;
            background: var(--light);
            border-radius: 8px;
            text-align: center;
        }

        .detail-label {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .detail-value {
            color: var(--dark);
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Booking Form */
        .booking-form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
        }

        .booking-form-card h2 {
            color: var(--dark);
            margin-bottom: 25px;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: var(--dark);
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
            outline: none;
        }

        .seat-map {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .seat-map h4 {
            color: var(--dark);
            margin-bottom: 15px;
            text-align: center;
        }

        .seat-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .seat {
            aspect-ratio: 1;
            background: white;
            border: 2px solid var(--border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .seat:hover {
            border-color: var(--primary);
            transform: scale(1.1);
        }

        .seat.selected {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .seat.occupied {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
            cursor: not-allowed;
        }

        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            font-size: 0.8rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .legend-color {
            width: 15px;
            height: 15px;
            border-radius: 3px;
        }

        .legend-available {
            background: white;
            border: 2px solid var(--border);
        }

        .legend-selected {
            background: var(--primary);
        }

        .legend-occupied {
            background: var(--danger);
        }

        .price-summary {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .price-row.total {
            border-top: 1px solid var(--border);
            padding-top: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--primary);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 115, 232, 0.3);
        }

        .btn-secondary {
            background: var(--light-gray);
            color: var(--dark);
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background: #d1d5db;
            transform: translateY(-2px);
        }

        /* Passenger Info */
        .passenger-info {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .passenger-info h4 {
            color: var(--dark);
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .booking-container {
                grid-template-columns: 1fr;
            }

            .flight-route {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .route-divider {
                transform: rotate(90deg);
                margin: 10px 0;
            }

            .flight-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .flight-price {
                text-align: center;
            }

            .seat-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>✈️ Pesan Tiket Penerbangan</h1>
            <p>Lengkapi informasi di bawah untuk memesan tiket Anda</p>
        </div>

        <div class="booking-container">
            <!-- Flight Details -->
            <div class="flight-details">
                <div class="flight-card">
                    <h2>📋 Detail Penerbangan</h2>
                    
                    <div class="flight-header">
                        <div class="airline-info">
                            <div class="airline-logo">{{ substr($flight->plane->airline->name, 0, 1) }}</div>
                            <div class="airline-details">
                                <h3>{{ $flight->plane->airline->name }}</h3>
                                <p>{{ $flight->plane->model }}</p>
                            </div>
                        </div>
                        <div class="flight-price">
                            <div class="price-amount">Rp{{ number_format($flight->price_per_seat, 0, ',', '.') }}</div>
                            <div class="price-label">per penumpang</div>
                        </div>
                    </div>

                    <div class="flight-route">
                        <div class="route-section">
                            <div class="route-city">{{ $flight->origin }}</div>
                            <div class="route-time">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</div>
                            <div class="route-date">{{ \Carbon\Carbon::parse($flight->departure_time)->format('d M Y') }}</div>
                        </div>
                        <div class="route-divider">→</div>
                        <div class="route-section">
                            <div class="route-city">{{ $flight->destination }}</div>
                            <div class="route-time">{{ \Carbon\Carbon::parse($flight->departure_time)->addHours(rand(2, 5))->format('H:i') }}</div>
                            <div class="route-date">{{ \Carbon\Carbon::parse($flight->departure_time)->addHours(rand(2, 5))->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="flight-details-grid">
                        <div class="detail-item">
                            <div class="detail-label">Durasi Penerbangan</div>
                            <div class="detail-value">{{ rand(2, 5) }}j {{ rand(0, 59) }}m</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Kelas</div>
                            <div class="detail-value">Ekonomi</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Jenis Penerbangan</div>
                            <div class="detail-value">Langsung</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Bagasi</div>
                            <div class="detail-value">20 kg</div>
                        </div>
                    </div>

                    <div class="passenger-info">
                        <h4>💺 Informasi Tempat Duduk</h4>
                        <p>Pilih kursi yang tersedia dari peta kursi di sebelah kanan. Kursi yang berwarna merah sudah dipesan oleh penumpang lain.</p>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="booking-form">
                <div class="booking-form-card">
                    <h2>🎫 Pesan Tiket</h2>

                    <form method="POST" action="{{ route('bookings.store', $flight->id) }}">
                        @csrf

                        <div class="seat-map">
                            <h4>Pilih Kursi</h4>
                            <div class="seat-grid" id="seatMap">
                                <!-- Seats will be generated by JavaScript -->
                            </div>
                            <div class="seat-legend">
                                <div class="legend-item">
                                    <div class="legend-color legend-available"></div>
                                    <span>Tersedia</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color legend-selected"></div>
                                    <span>Dipilih</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color legend-occupied"></div>
                                    <span>Terisi</span>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="seat_number" id="selectedSeat" required>

                        <div class="form-group">
                            <label class="form-label" for="passenger_name">Nama Lengkap Penumpang</label>
                            <input type="text" class="form-control" id="passenger_name" name="passenger_name" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="passenger_email">Email</label>
                            <input type="email" class="form-control" id="passenger_email" name="passenger_email" placeholder="Masukkan email" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="passenger_phone">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="passenger_phone" name="passenger_phone" placeholder="Masukkan nomor telepon" required>
                        </div>

                        <div class="price-summary">
                            <div class="price-row">
                                <span>Harga Tiket</span>
                                <span>Rp{{ number_format($flight->price_per_seat, 0, ',', '.') }}</span>
                            </div>
                            <div class="price-row">
                                <span>Biaya Layanan</span>
                                <span>Rp25.000</span>
                            </div>
                            <div class="price-row">
                                <span>Pajak Bandara</span>
                                <span>Rp50.000</span>
                            </div>
                            <div class="price-row total">
                                <span>Total Pembayaran</span>
                                <span>Rp{{ number_format($flight->price_per_seat + 75000, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="bookButton">
                            💳 Pesan Sekarang - Rp{{ number_format($flight->price_per_seat + 75000, 0, ',', '.') }}
                        </button>
                        
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seatMap = document.getElementById('seatMap');
            const selectedSeatInput = document.getElementById('selectedSeat');
            const bookButton = document.getElementById('bookButton');
            
            // Generate seat map
            const rows = 5;
            const seatsPerRow = 6;
            const occupiedSeats = ['1A', '2C', '3F', '4B', '5D']; // Example occupied seats
            
            for (let row = 1; row <= rows; row++) {
                for (let seatNum = 0; seatNum < seatsPerRow; seatNum++) {
                    const seatLetter = String.fromCharCode(65 + seatNum);
                    const seatId = `${row}${seatLetter}`;
                    const seat = document.createElement('div');
                    seat.className = 'seat';
                    seat.textContent = seatId;
                    seat.dataset.seat = seatId;
                    
                    if (occupiedSeats.includes(seatId)) {
                        seat.classList.add('occupied');
                    }
                    
                    seat.addEventListener('click', function() {
                        if (!this.classList.contains('occupied')) {
                            // Remove selected class from all seats
                            document.querySelectorAll('.seat').forEach(s => {
                                s.classList.remove('selected');
                            });
                            
                            // Add selected class to clicked seat
                            this.classList.add('selected');
                            selectedSeatInput.value = seatId;
                            
                            // Enable book button
                            bookButton.disabled = false;
                        }
                    });
                    
                    seatMap.appendChild(seat);
                }
            }
            
            // Initially disable book button until seat is selected
            bookButton.disabled = true;
            
            // Form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                if (!selectedSeatInput.value) {
                    e.preventDefault();
                    alert('Silakan pilih kursi terlebih dahulu!');
                    return;
                }
                
                // Show loading state
                bookButton.innerHTML = '⏳ Memproses Pemesanan...';
                bookButton.disabled = true;
            });
            
            // Real-time form validation
            const inputs = document.querySelectorAll('input[required]');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    const allFilled = Array.from(inputs).every(input => input.value.trim() !== '');
                    const seatSelected = selectedSeatInput.value !== '';
                    bookButton.disabled = !(allFilled && seatSelected);
                });
            });
        });
    </script>
</body>
</html>