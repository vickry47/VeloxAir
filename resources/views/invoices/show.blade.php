<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->invoice_number }} - SkyWings Airlines</title>
    <style>
        :root {
            --primary: #1a73e8;
            --primary-dark: #0d47a1;
            --secondary: #f57c00;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
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
            max-width: 800px;
            margin: 0 auto;
        }

        .invoice-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .invoice-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .invoice-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
            background-size: 20px 20px;
        }

        .invoice-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
        }

        .invoice-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .invoice-number {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            display: inline-block;
            backdrop-filter: blur(10px);
        }

        .invoice-body {
            padding: 40px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--success);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-section {
            background: var(--light);
            padding: 25px;
            border-radius: 10px;
            border-left: 4px solid var(--primary);
        }

        .info-section h3 {
            color: var(--dark);
            margin-bottom: 15px;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
        }

        .info-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .info-label {
            color: var(--gray);
            font-weight: 500;
        }

        .info-value {
            color: var(--dark);
            font-weight: 600;
            text-align: right;
        }

        .flight-details {
            background: white;
            border: 2px solid var(--light-gray);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .flight-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .airline-info {
            display: flex;
            align-items: center;
            gap: 15px;
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

        .airline-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
        }

        .flight-route {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            padding: 20px;
            background: var(--light);
            border-radius: 8px;
        }

        .route-section {
            text-align: center;
        }

        .route-city {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .route-time {
            font-size: 1.1rem;
            color: var(--gray);
        }

        .route-date {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .route-divider {
            text-align: center;
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: bold;
        }

        .price-breakdown {
            background: var(--light);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .price-breakdown h3 {
            color: var(--dark);
            margin-bottom: 20px;
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .price-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .price-row.total {
            border-top: 2px solid var(--primary);
            padding-top: 15px;
            margin-top: 15px;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .price-label {
            color: var(--gray);
        }

        .price-amount {
            color: var(--dark);
            font-weight: 600;
        }

        .total-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
        }

        .total-label {
            font-size: 1.1rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .total-amount {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .payment-method {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
        }

        .invoice-footer {
            background: var(--light);
            padding: 30px;
            text-align: center;
            border-top: 1px solid var(--border);
        }

        .thank-you {
            color: var(--dark);
            font-size: 1.2rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .contact-info {
            color: var(--gray);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
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
        }

        .btn-secondary:hover {
            background: #d1d5db;
            transform: translateY(-2px);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .print-only {
            display: none;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .container {
                max-width: none;
                margin: 0;
            }
            
            .invoice-card {
                box-shadow: none;
                border-radius: 0;
            }
            
            .btn {
                display: none;
            }
            
            .print-only {
                display: block;
            }
            
            .no-print {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .invoice-body {
                padding: 25px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .flight-route {
                grid-template-columns: 1fr;
                gap: 10px;
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
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-card">
            <!-- Invoice Header -->
            <div class="invoice-header">
                <h1 class="invoice-title">✈️ INVOICE</h1>
                <p class="invoice-subtitle">SkyWings Airlines - Booking Confirmation</p>
                <div class="invoice-number">#{{ $invoice->invoice_number }}</div>
            </div>

            <!-- Invoice Body -->
            <div class="invoice-body">
                <div class="status-badge">
                    <span>✅</span> Pembayaran Berhasil
                </div>

                <!-- Information Grid -->
                <div class="info-grid">
                    <div class="info-section">
                        <h3>📅 Informasi Invoice</h3>
                        <div class="info-item">
                            <span class="info-label">Nomor Invoice</span>
                            <span class="info-value">#{{ $invoice->invoice_number }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tanggal Invoice</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d F Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status</span>
                            <span class="info-value" style="color: var(--success);">Lunas</span>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3>👤 Informasi Penumpang</h3>
                        <div class="info-item">
                            <span class="info-label">Nama Penumpang</span>
                            <span class="info-value">{{ $invoice->payment->booking->passenger_name ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $invoice->payment->booking->passenger_email ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">No. Telepon</span>
                            <span class="info-value">{{ $invoice->payment->booking->passenger_phone ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Flight Details -->
                <div class="flight-details">
                    <div class="flight-header">
                        <div class="airline-info">
                            <div class="airline-logo">
                                {{ substr($invoice->payment->booking->flight->plane->airline->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="airline-name">{{ $invoice->payment->booking->flight->plane->airline->name }}</div>
                                <div style="color: var(--gray); font-size: 0.9rem;">
                                    {{ $invoice->payment->booking->flight->plane->model }}
                                </div>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div style="color: var(--gray); font-size: 0.9rem;">Kelas</div>
                            <div style="font-weight: 600; color: var(--dark);">
                                {{ ucfirst($invoice->payment->booking->seat_class ?? 'economy') }}
                            </div>
                        </div>
                    </div>

                    <div class="flight-route">
                        <div class="route-section">
                            <div class="route-city">{{ $invoice->payment->booking->flight->origin }}</div>
                            <div class="route-time">
                                {{ \Carbon\Carbon::parse($invoice->payment->booking->flight->departure_time)->format('H:i') }}
                            </div>
                            <div class="route-date">
                                {{ \Carbon\Carbon::parse($invoice->payment->booking->flight->departure_time)->format('d M Y') }}
                            </div>
                        </div>
                        <div class="route-divider">→</div>
                        <div class="route-section">
                            <div class="route-city">{{ $invoice->payment->booking->flight->destination }}</div>
                            <div class="route-time">
                                {{ \Carbon\Carbon::parse($invoice->payment->booking->flight->departure_time)->addHours(rand(2, 5))->format('H:i') }}
                            </div>
                            <div class="route-date">
                                {{ \Carbon\Carbon::parse($invoice->payment->booking->flight->departure_time)->addHours(rand(2, 5))->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                        <div style="text-align: center; padding: 12px; background: var(--light); border-radius: 6px;">
                            <div style="color: var(--gray); font-size: 0.8rem;">Kursi</div>
                            <div style="font-weight: 600; color: var(--dark);">{{ $invoice->payment->booking->seat_number }}</div>
                        </div>
                        <div style="text-align: center; padding: 12px; background: var(--light); border-radius: 6px;">
                            <div style="color: var(--gray); font-size: 0.8rem;">Durasi</div>
                            <div style="font-weight: 600; color: var(--dark);">{{ rand(2, 5) }}j {{ rand(0, 59) }}m</div>
                        </div>
                        <div style="text-align: center; padding: 12px; background: var(--light); border-radius: 6px;">
                            <div style="color: var(--gray); font-size: 0.8rem;">Bagasi</div>
                            <div style="font-weight: 600; color: var(--dark);">20 kg</div>
                        </div>
                    </div>
                </div>

                <!-- Price Breakdown -->
                <div class="price-breakdown">
                    <h3>💰 Rincian Biaya</h3>
                    <div class="price-row">
                        <span class="price-label">Harga Tiket</span>
                        <span class="price-amount">Rp{{ number_format($invoice->payment->booking->flight->price_per_seat, 0, ',', '.') }}</span>
                    </div>
                    @if($invoice->payment->booking->seat_class === 'business')
                    <div class="price-row">
                        <span class="price-label">Upgrade Kelas Bisnis</span>
                        <span class="price-amount">Rp{{ number_format($invoice->payment->booking->flight->price_per_seat * 1.5, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="price-row">
                        <span class="price-label">Biaya Layanan</span>
                        <span class="price-amount">Rp25.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Pajak Bandara</span>
                        <span class="price-amount">Rp50.000</span>
                    </div>
                    <div class="price-row total">
                        <span class="price-label">Total Pembayaran</span>
                        <span class="price-amount">Rp{{ number_format($invoice->payment->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Total Section -->
                <div class="total-section">
                    <div class="total-label">Total yang telah dibayar</div>
                    <div class="total-amount">Rp{{ number_format($invoice->payment->amount, 0, ',', '.') }}</div>
                    <div class="payment-method">
                        <span>
                            @if($invoice->payment->method === 'credit_card')
                            💳 
                            @elseif($invoice->payment->method === 'bank_transfer')
                            🏦
                            @else
                            📱
                            @endif
                        </span>
                        {{ ucfirst(str_replace('_', ' ', $invoice->payment->method)) }}
                    </div>
                </div>
            </div>

            <!-- Invoice Footer -->
            <div class="invoice-footer">
                <div class="thank-you">Terima kasih telah memilih SkyWings Airlines!</div>
                <div class="contact-info">
                    Untuk pertanyaan lebih lanjut, hubungi customer service kami di<br>
                    📞 +62 21 1234 5678 | ✉️ support@skywings.com
                </div>
                
                <div class="action-buttons no-print">
                    <button onclick="window.print()" class="btn btn-primary">
                        🖨️ Cetak Invoice
                    </button>
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                        ← Kembali ke Riwayat Booking
                    </a>
                    <button class="btn btn-success" onclick="downloadETicket()">
                        🎫 Download E-Ticket
                    </button>
                </div>

                <div class="print-only">
                    <p style="color: var(--gray); margin-top: 20px;">
                        Invoice ini dicetak pada {{ \Carbon\Carbon::now()->format('d F Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadETicket() {
            // Simulasi download e-ticket
            alert('Fitur download E-Ticket akan segera tersedia!');
            // Dalam implementasi nyata, ini akan mengunduh file PDF
        }

        // Auto-print jika parameter print ada di URL
        if (window.location.search.includes('print=true')) {
            window.print();
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>