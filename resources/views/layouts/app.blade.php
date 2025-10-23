<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VeloxAir - Booking Tiket Pesawat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-plane text-2xl"></i>
                    <span class="text-xl font-bold">VeloxAir</span>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('flights.index') }}" class="hover:text-blue-200">
                        <i class="fas fa-search mr-1"></i>Cari Penerbangan
                    </a>
                    
                    @auth
                        <a href="{{ route('bookings.index') }}" class="hover:text-blue-200">
                            <i class="fas fa-ticket-alt mr-1"></i>Pemesanan Saya
                        </a>
                        
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 px-3 py-1 rounded hover:bg-blue-400">
                                <i class="fas fa-cog mr-1"></i>Admin Panel
                            </a>
                        @endif
                        
                        <div class="relative group">
                            <button class="flex items-center space-x-2 hover:text-blue-200">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    {{ auth()->user()->avatar }}
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-blue-200">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-500 px-3 py-1 rounded hover:bg-blue-400">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex justify-center items-center space-x-2 mb-4">
                <i class="fas fa-plane text-2xl"></i>
                <span class="text-xl font-bold">VeloxAir</span>
            </div>
            <p class="text-gray-400">Website Booking Tiket Pesawat Terpercaya di Indonesia</p>
            <p class="text-gray-400 mt-2">&copy; 2024 VeloxAir. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Simple dropdown functionality
        document.addEventListener('click', function(e) {
            if (!e.target.matches('.group button')) {
                document.querySelectorAll('.group .hidden').forEach(function(dropdown) {
                    dropdown.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>