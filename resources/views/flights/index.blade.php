<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penerbangan - SkyWings Airlines</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content h1 {
            color: var(--dark);
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header-content p {
            color: var(--gray);
            font-size: 1.1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
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

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            background: var(--danger);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        /* Filter Section */
        .filter-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .filter-title {
            color: var(--dark);
            margin-bottom: 20px;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            color: var(--gray);
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .filter-select, .filter-input {
            padding: 12px 15px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .filter-select:focus, .filter-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
            outline: none;
        }

        .filter-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
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
        }

        .btn-secondary {
            background: var(--light-gray);
            color: var(--dark);
        }

        .btn-secondary:hover {
            background: #d1d5db;
            transform: translateY(-2px);
        }

        /* Flight Cards */
        .flight-cards {
            display: grid;
            gap: 20px;
        }

        .flight-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            border-left: 5px solid var(--primary);
        }

        .flight-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .flight-header {
            display: flex;
            justify-content: between;
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
        }

        .airline-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        .plane-model {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .flight-price {
            text-align: right;
        }

        .price-label {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .price-amount {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }

        .price-per {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .flight-route {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
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

        .route-divider {
            text-align: center;
            color: var(--primary);
            font-weight: bold;
        }

        .flight-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            text-align: center;
            padding: 10px;
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

        .flight-actions {
            display: flex;
            justify-content: flex-end;
        }

        .btn-book {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-book:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 115, 232, 0.3);
        }

        /* Empty State */
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

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
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

            .flight-price {
                text-align: center;
            }

            .filter-actions {
                justify-content: stretch;
            }

            .filter-actions .btn {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <div class="header-content">
                <h1>✈️ Daftar Penerbangan</h1>
                <p>Temukan penerbangan terbaik untuk perjalanan Anda</p>
            </div>
            <div class="user-info">
                <div class="user-avatar">U</div>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>

        <!-- Filter Section -->
        <!-- <div class="filter-section">
            <h3 class="filter-title">🔍 Filter Pencarian</h3>
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Asal</label>
                    <select class="filter-select">
                        <option value="">Semua Kota</option>
                        <option value="jakarta">Jakarta (CGK)</option>
                        <option value="surabaya">Surabaya (SUB)</option>
                        <option value="denpasar">Denpasar (DPS)</option>
                        <option value="medan">Medan (KNO)</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Tujuan</label>
                    <select class="filter-select">
                        <option value="">Semua Kota</option>
                        <option value="jakarta">Jakarta (CGK)</option>
                        <option value="surabaya">Surabaya (SUB)</option>
                        <option value="denpasar">Denpasar (DPS)</option>
                        <option value="medan">Medan (KNO)</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Tanggal Berangkat</label>
                    <input type="date" class="filter-input">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Maskapai</label>
                    <select class="filter-select">
                        <option value="">Semua Maskapai</option>
                        <option value="garuda">Garuda Indonesia</option>
                        <option value="lion">Lion Air</option>
                        <option value="citilink">Citilink</option>
                        <option value="airasia">AirAsia</option>
                    </select>
                </div>
            </div> -->
            <!-- <div class="filter-actions">
                <button class="btn btn-secondary">Reset Filter</button>
                <button class="btn btn-primary">Terapkan Filter</button>
            </div>
        </div> -->

        <!-- Flight List -->
        <div class="flight-cards">
            @if(count($flights) > 0)
                @foreach($flights as $flight)
                    <div class="flight-card">
                        <div class="flight-header">
                            <div class="airline-info">
                                <div class="airline-logo">{{ substr($flight->plane->airline->name, 0, 1) }}</div>
                                <div>
                                    <div class="airline-name">{{ $flight->plane->airline->name }}</div>
                                    <div class="plane-model">{{ $flight->plane->model }}</div>
                                </div>
                            </div>
                            <div class="flight-price">
                                <div class="price-label">Mulai dari</div>
                                <div class="price-amount">Rp{{ number_format($flight->price_per_seat, 0, ',', '.') }}</div>
                                <div class="price-per">per penumpang</div>
                            </div>
                        </div>

                        <div class="flight-route">
                            <div class="route-section">
                                <div class="route-city">{{ $flight->origin }}</div>
                                <div class="route-time">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</div>
                            </div>
                            <div class="route-divider">→</div>
                            <div class="route-section">
                                <div class="route-city">{{ $flight->destination }}</div>
                                <div class="route-time">{{ \Carbon\Carbon::parse($flight->departure_time)->addHours(rand(1, 6))->format('H:i') }}</div>
                            </div>
                        </div>

                        <div class="flight-details">
                            <div class="detail-item">
                                <div class="detail-label">Durasi</div>
                                <div class="detail-value">{{ rand(1, 6) }}j {{ rand(0, 59) }}m</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Kelas</div>
                                <div class="detail-value">Ekonomi</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Tersedia</div>
                                <div class="detail-value">{{ rand(10, 50) }} kursi</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Penerbangan</div>
                                <div class="detail-value">Langsung</div>
                            </div>
                        </div>

                        <div class="flight-actions">
                            <a href="{{ route('flights.show', $flight->id) }}" class="btn-book">Pesan Sekarang</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">✈️</div>
                    <h3 class="empty-title">Tidak Ada Penerbangan Ditemukan</h3>
                    <p class="empty-description">Coba ubah filter pencarian Anda atau cari dengan kriteria yang berbeda.</p>
                    <button class="btn btn-primary">Reset Pencarian</button>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Simple filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelects = document.querySelectorAll('.filter-select, .filter-input');
            const resetBtn = document.querySelector('.btn-secondary');
            const applyBtn = document.querySelector('.btn-primary');

            // Reset filter
            resetBtn.addEventListener('click', function() {
                filterSelects.forEach(select => {
                    if (select.type === 'date') {
                        select.value = '';
                    } else {
                        select.value = '';
                    }
                });
            });

            // Apply filter (placeholder functionality)
            applyBtn.addEventListener('click', function() {
                alert('Filter diterapkan!');
                // In real implementation, this would submit a form or make an API call
            });

            // Add some interactive elements
            const flightCards = document.querySelectorAll('.flight-card');
            flightCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    if (!e.target.classList.contains('btn-book')) {
                        // In real implementation, this could show more details
                        console.log('Flight card clicked');
                    }
                });
            });
        });
    </script>
</body>
</html>