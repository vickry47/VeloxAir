<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Booking #{{ $booking->id }} - SkyWings Airlines</title>
    <style>
        :root {
            --primary: #1a73e8;
            --primary-dark: #0d47a1;
            --secondary: #f57c00;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #28a745;
            --warning: #ffc107;
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

        .booking-id {
            background: var(--primary);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
            margin-top: 10px;
        }

        .payment-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        /* Flight Summary */
        .flight-summary {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .flight-summary h2 {
            color: var(--dark);
            margin-bottom: 25px;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .airline-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .airline-logo {
            width: 50px;
            height: 50px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .airline-details h3 {
            color: var(--dark);
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .airline-details p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .flight-route {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            padding: 20px;
            background: var(--light);
            border-radius: 10px;
        }

        .route-section {
            text-align: center;
        }

        .route-city {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .route-time {
            font-size: 1rem;
            color: var(--gray);
        }

        .route-date {
            font-size: 0.8rem;
            color: var(--gray);
        }

        .route-divider {
            text-align: center;
            color: var(--primary);
            font-weight: bold;
            font-size: 1.5rem;
        }

        .booking-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            padding: 12px;
            background: var(--light);
            border-radius: 8px;
            text-align: center;
        }

        .detail-label {
            color: var(--gray);
            font-size: 0.8rem;
            margin-bottom: 5px;
        }

        .detail-value {
            color: var(--dark);
            font-weight: 600;
        }

        /* Payment Form */
        .payment-form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .payment-form-card h2 {
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
            margin-bottom: 10px;
            font-weight: 500;
            font-size: 1rem;
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

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .payment-method {
            border: 2px solid var(--border);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .payment-method:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .payment-method.selected {
            border-color: var(--primary);
            background: rgba(26, 115, 232, 0.05);
        }

        .payment-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .payment-name {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .payment-details {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .price-summary {
            margin-bottom: 15px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
        }

        .price-row.total {
            border-bottom: none;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--primary);
            padding-top: 10px;
            border-top: 2px solid var(--border);
        }

        .countdown-timer {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid var(--warning);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
        }

        .timer-text {
            color: var(--warning);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .timer-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--warning);
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

        .security-badges {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .security-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--gray);
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .payment-container {
                grid-template-columns: 1fr;
            }

            .flight-route {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .route-divider {
                transform: rotate(90deg);
                margin: 10px 0;
            }

            .booking-details {
                grid-template-columns: 1fr;
            }

            .payment-methods {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>💳 Pembayaran Tiket</h1>
            <p>Selesaikan pembayaran untuk mengkonfirmasi booking Anda</p>
            <div class="booking-id">Booking #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>

        <div class="payment-container">
            <!-- Flight Summary -->
            <div class="flight-summary">
                <h2>📋 Ringkasan Penerbangan</h2>
                
                <div class="airline-info">
                    <div class="airline-logo">{{ substr($booking->flight->plane->airline->name, 0, 1) }}</div>
                    <div class="airline-details">
                        <h3>{{ $booking->flight->plane->airline->name }}</h3>
                        <p>{{ $booking->flight->plane->model }}</p>
                    </div>
                </div>

                <div class="flight-route">
                    <div class="route-section">
                        <div class="route-city">{{ $booking->flight->origin }}</div>
                        <div class="route-time">{{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('H:i') }}</div>
                        <div class="route-date">{{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('d M Y') }}</div>
                    </div>
                    <div class="route-divider">→</div>
                    <div class="route-section">
                        <div class="route-city">{{ $booking->flight->destination }}</div>
                        <div class="route-time">{{ \Carbon\Carbon::parse($booking->flight->departure_time)->addHours(rand(2, 5))->format('H:i') }}</div>
                        <div class="route-date">{{ \Carbon\Carbon::parse($booking->flight->departure_time)->addHours(rand(2, 5))->format('d M Y') }}</div>
                    </div>
                </div>

                <div class="booking-details">
                    <div class="detail-item">
                        <div class="detail-label">Kursi</div>
                        <div class="detail-value">{{ $booking->seat_number }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Kelas</div>
                        <div class="detail-value">Ekonomi</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Durasi</div>
                        <div class="detail-value">{{ rand(2, 5) }}j {{ rand(0, 59) }}m</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Penumpang</div>
                        <div class="detail-value">1 Orang</div>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="payment-form-card">
                <h2>💰 Metode Pembayaran</h2>

                <div class="countdown-timer">
                    <div class="timer-text">Selesaikan pembayaran dalam:</div>
                    <div class="timer-value" id="countdown">15:00</div>
                </div>

                <form method="POST" action="{{ route('bookings.pay', $booking->id) }}" id="paymentForm">
                    @csrf
                    
                    <input type="hidden" name="method" id="paymentMethod" required>

                    <div class="form-group">
                        <label class="form-label">Pilih Metode Pembayaran</label>
                        <div class="payment-methods">
                            <div class="payment-method" data-method="credit_card">
                                <div class="payment-icon">💳</div>
                                <div class="payment-name">Credit Card</div>
                            </div>
                            <div class="payment-method" data-method="bank_transfer">
                                <div class="payment-icon">🏦</div>
                                <div class="payment-name">Bank Transfer</div>
                            </div>
                            <div class="payment-method" data-method="e_wallet">
                                <div class="payment-icon">📱</div>
                                <div class="payment-name">E-Wallet</div>
                            </div>
                        </div>
                    </div>

                    <div class="payment-details">
                        <div class="price-summary">
                            <div class="price-row">
                                <span>Harga Tiket</span>
                                <span>Rp{{ number_format($booking->flight->price_per_seat, 0, ',', '.') }}</span>
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
                                <span>Rp{{ number_format($booking->flight->price_per_seat + 75000, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="payButton">
                        💳 Bayar Sekarang - Rp{{ number_format($booking->flight->price_per_seat + 75000, 0, ',', '.') }}
                    </button>
                    
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                        ← Kembali ke Riwayat Booking
                    </a>
                </form>

                <div class="security-badges">
                    <div class="security-badge">
                        <span>🔒</span> Aman & Terenkripsi
                    </div>
                    <div class="security-badge">
                        <span>🛡️</span> PCI Compliant
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethods = document.querySelectorAll('.payment-method');
            const paymentMethodInput = document.getElementById('paymentMethod');
            const payButton = document.getElementById('payButton');
            const paymentForm = document.getElementById('paymentForm');
            
            // Payment method selection
            paymentMethods.forEach(method => {
                method.addEventListener('click', function() {
                    // Remove selected class from all methods
                    paymentMethods.forEach(m => m.classList.remove('selected'));
                    
                    // Add selected class to clicked method
                    this.classList.add('selected');
                    
                    // Set the value in hidden input
                    paymentMethodInput.value = this.dataset.method;
                    
                    // Enable pay button
                    payButton.disabled = false;
                });
            });
            
            // Initially disable pay button
            payButton.disabled = true;
            
            // Countdown timer (15 minutes)
            let timeLeft = 15 * 60; // 15 minutes in seconds
            const countdownElement = document.getElementById('countdown');
            
            function updateCountdown() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (timeLeft > 0) {
                    timeLeft--;
                } else {
                    countdownElement.textContent = 'Waktu Habis';
                    countdownElement.style.color = 'var(--danger)';
                    payButton.disabled = true;
                    payButton.textContent = 'Waktu Pembayaran Habis';
                }
            }
            
            // Update countdown every second
            setInterval(updateCountdown, 1000);
            updateCountdown(); // Initial call
            
            // Form submission
            paymentForm.addEventListener('submit', function(e) {
                if (!paymentMethodInput.value) {
                    e.preventDefault();
                    alert('Silakan pilih metode pembayaran terlebih dahulu!');
                    return;
                }
                
                // Show loading state
                payButton.innerHTML = '⏳ Memproses Pembayaran...';
                payButton.disabled = true;
                
                // In real implementation, you might want to add actual payment processing here
            });
            
            // Add some visual feedback
            paymentMethods.forEach(method => {
                method.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('selected')) {
                        this.style.transform = 'translateY(-2px)';
                    }
                });
                
                method.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('selected')) {
                        this.style.transform = 'translateY(0)';
                    }
                });
            });
        });
    </script>
</body>
</html>