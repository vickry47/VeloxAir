<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SkyWings Airlines</title>
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .illustration {
            flex: 1;
            background: linear-gradient(rgba(26, 115, 232, 0.8), rgba(13, 71, 161, 0.9)), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><path fill="%23ffffff" fill-opacity="0.1" d="M0,0V800H1200V0ZM800,400C800,533.33,666.67,600,600,600S400,533.33,400,400,533.33,200,600,200,800,266.67,800,400Z"/></svg>');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            text-align: center;
        }

        .illustration h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .illustration p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .plane-icon {
            font-size: 5rem;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .login-form {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h2 {
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 700;
        }

        .login-form p {
            color: var(--gray);
            margin-bottom: 30px;
        }

        /* Floating Label Styles */
        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-control {
            width: 100%;
            padding: 16px 15px 10px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: transparent;
            z-index: 1;
            position: relative;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
            outline: none;
        }

        .form-label {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            transition: all 0.3s;
            pointer-events: none;
            background-color: white;
            padding: 0 5px;
            z-index: 0;
        }

        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            top: 0;
            transform: translateY(-50%);
            font-size: 0.8rem;
            color: var(--primary);
            font-weight: 600;
            z-index: 2;
        }

        .form-control:focus + .form-label {
            color: var(--primary);
        }

        /* Untuk browser yang tidak mendukung :placeholder-shown */
        .form-control.filled + .form-label {
            top: 0;
            transform: translateY(-50%);
            font-size: 0.8rem;
            color: var(--primary);
            font-weight: 600;
            z-index: 2;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            width: 100%;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--danger);
        }

        .error-message p {
            margin: 0;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            color: var(--gray);
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid var(--light-gray);
        }

        .divider span {
            padding: 0 10px;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-btn {
            flex: 1;
            padding: 10px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .social-btn:hover {
            background-color: var(--light);
            transform: translateY(-2px);
        }

        .social-btn.google {
            color: #DB4437;
        }

        .social-btn.facebook {
            color: #4267B2;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .illustration {
                padding: 30px 20px;
            }
            
            .illustration h1 {
                font-size: 2rem;
            }
            
            .login-form {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <div class="plane-icon">✈️</div>
            <h1>SkyWings Airlines</h1>
            <p>Nikmati perjalanan yang nyaman dan aman bersama kami. Jelajahi dunia dengan tiket pesawat terbaik.</p>
            <p>Bergabunglah dengan jutaan pelanggan yang telah mempercayai perjalanan mereka kepada kami.</p>
        </div>
        <div class="login-form">
            <h2>Masuk ke Akun Anda</h2>
            <p>Selamat datang kembali! Silakan masuk ke akun Anda.</p>
            
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control" placeholder=" " value="{{ old('email') }}" required>
                    <label for="email" class="form-label">Email</label>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder=" " required>
                    <label for="password" class="form-label">Password</label>
                </div>
                <button type="submit" class="btn">Masuk</button>
            </form>

            <div class="divider">
                <span>Atau masuk dengan</span>
            </div>

            <div class="social-login">
                <button type="button" class="social-btn google">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </button>
                <button type="button" class="social-btn facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </button>
            </div>

            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk floating labels (fallback untuk browser lama)
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            
            inputs.forEach(input => {
                // Cek apakah input sudah memiliki nilai (setelah refresh halaman)
                if (input.value) {
                    input.classList.add('filled');
                }
                
                // Tambahkan event listener untuk perubahan nilai
                input.addEventListener('input', function() {
                    if (this.value) {
                        this.classList.add('filled');
                    } else {
                        this.classList.remove('filled');
                    }
                });
                
                // Tambahkan event listener untuk focus
                input.addEventListener('focus', function() {
                    this.classList.add('filled');
                });
                
                // Tambahkan event listener untuk blur
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.classList.remove('filled');
                    }
                });
            });
        });
    </script>
</body>
</html>