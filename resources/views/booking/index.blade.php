<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - SkyWings Airlines</title>
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
            max-width: 1200px;
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

        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            border: 1px solid var(--primary);
            border-radius: 8px;
            transition: all 0.3s;
        }

        .back-link:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .booking-cards {
            display: grid;
            gap: 20px;
        }

        .booking-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            border-left: 5px solid var(--primary);
        }

        .booking-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .booking-info h3 {
            color: var(--dark);
            font-size: 1.3rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .airline-badge {
            background: var(--primary);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .booking-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .booking-status {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-align: center;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning);
            border: 1px solid var(--warning);
        }

        .status-confirmed {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 1px solid var(--success);
        }

        .status-cancelled {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .status-completed {
            background: rgba(108, 117, 125, 0.1);
            color: var(--gray);
            border: 1px solid var(--gray);
        }

        .booking-route {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
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
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            text-align: center;
            padding: 12px;
            background: var(--light);
            border-radius: 8px;
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

        .booking-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--light-gray);
            color: var(--dark);
        }

        .btn-secondary:hover {
            background: #d1d5db;
            transform: translateY(-2px);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--gray);
        }

        .empty-title {
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 1.5rem;
        }

        .empty-description {
            color: var(--gray);
            margin-bottom: 30px;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid var(--success);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .booking-header {
                flex-direction: column;
                gap: 15px;
            }

            .booking-route {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .route-divider {
                transform: rotate(90deg);
                margin: 10px 0;
            }

            .booking-actions {
                justify-content: stretch;
            }

            .booking-actions .btn {
                flex: 1;
                justify-content: center;
            }

            .stats-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📋 Riwayat Booking Saya</h1>
            <p>Kelola dan pantau semua pemesanan tiket Anda di satu tempat</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert-success">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <!-- Navigation -->
        <div class="navigation">
            <a href="{{ route('flights.index') }}" class="back-link">
                ← Kembali ke Daftar Penerbangan
            </a>
        </div>

        <!-- Statistics -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-number">{{ $bookings->count() }}</div>
                <div class="stat-label">Total Booking</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⏳</div>
                <div class="stat-number">{{ $bookings->where('status', 'pending')->count() }}</div>
                <div class="stat-label">Menunggu Pembayaran</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-number">{{ $bookings->where('status', 'confirmed')->count() }}</div>
                <div class="stat-label">Terkonfirmasi</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🎫</div>
                <div class="stat-number">{{ $bookings->where('status', 'completed')->count() }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>

        <!-- Booking List -->
        <div class="booking-cards">
            @forelse($bookings as $booking)
                <div class="booking-card">
                    <div class="booking-header">
                        <div class="booking-info">
                            <h3>
                                {{ $booking->flight->plane->airline->name }}
                                <span class="airline-badge">{{ $booking->flight->plane->model }}</span>
                            </h3>
                            <div class="booking-meta">
                                <div class="meta-item">
                                    <span>📅</span>
                                    {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}
                                </div>
                                <div class="meta-item">
                                    <span>🆔</span>
                                    Booking #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        </div>
                        <div class="booking-status status-{{ $booking->status }}">
                            {{ ucfirst($booking->status) }}
                        </div>
                    </div>

                    <div class="booking-route">
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
                            <div class="detail-label">Harga</div>
                            <div class="detail-value">Rp{{ number_format($booking->flight->price_per_seat + 75000, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <div class="booking-actions">
                        @if($booking->status === 'pending')
                            <a href="{{ route('bookings.payment.form', $booking->id) }}" class="btn btn-primary">
                                💳 Bayar Sekarang
                            </a>
                            <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                    ❌ Batalkan
                                </button>
                            </form>
                        @elseif($booking->status === 'confirmed')
                            <button class="btn btn-secondary" disabled>
                                ✅ Terkonfirmasi
                            </button>
                            <a href="#" class="btn btn-primary">
                                📄 Download E-Ticket
                            </a>
                        @elseif($booking->status === 'completed')
                            <button class="btn btn-secondary" disabled>
                                🎫 Perjalanan Selesai
                            </button>
                        @else
                            <button class="btn btn-secondary" disabled>
                                Tidak ada aksi
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h3 class="empty-title">Belum Ada Booking</h3>
                    <p class="empty-description">Anda belum memiliki riwayat pemesanan tiket. Mulai pesan tiket pertama Anda sekarang!</p>
                    <a href="{{ route('flights.index') }}" class="btn btn-primary">
                        ✈️ Cari Penerbangan
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add confirmation for cancel actions
            const cancelButtons = document.querySelectorAll('.btn-danger');
            cancelButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Apakah Anda yakin ingin membatalkan booking ini?')) {
                        e.preventDefault();
                    }
                });
            });

            // Add loading states for buttons
            const actionButtons = document.querySelectorAll('.btn');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!this.disabled) {
                        const originalText = this.innerHTML;
                        this.innerHTML = '⏳ Memproses...';
                        this.disabled = true;
                        
                        // Revert after 3 seconds if still on same page
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }, 3000);
                    }
                });
            });
        });
    </script>
</body>
</html>