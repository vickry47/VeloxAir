<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SkyWings Airlines</title>
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

        .register-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-height: 100vh;
            overflow-y: auto;
        }

        .register-form h2 {
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 700;
        }

        .register-form p {
            color: var(--gray);
            margin-bottom: 25px;
        }

        /* Floating Label Styles */
        .form-group {
            position: relative;
            margin-bottom: 25px;
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

        .password-requirements {
            background-color: var(--light);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary);
        }

        .password-requirements h4 {
            color: var(--dark);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .password-requirements ul {
            list-style: none;
            padding-left: 0;
        }

        .password-requirements li {
            color: var(--gray);
            font-size: 0.8rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .password-requirements li::before {
            content: "•";
            color: var(--primary);
            font-weight: bold;
            margin-right: 8px;
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

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: var(--gray);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .terms {
            margin: 20px 0;
            font-size: 0.85rem;
            color: var(--gray);
            text-align: center;
        }

        .terms a {
            color: var(--primary);
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
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
            
            .register-form {
                padding: 30px 25px;
                max-height: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <div class="plane-icon">✈️</div>
            <h1>SkyWings Airlines</h1>
            <p>Bergabunglah dengan komunitas traveler kami dan nikmati kemudahan dalam memesan tiket pesawat.</p>
            <p>Dapatkan penawaran eksklusif dan akses prioritas ke promo terbaik.</p>
        </div>
        <div class="register-form">
            <h2>Buat Akun Baru</h2>
            <p>Isi data diri Anda untuk mulai menjelajahi dunia bersama kami.</p>
            
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input type="text" id="name" name="name" class="form-control" placeholder=" " value="{{ old('name') }}" required>
                    <label for="name" class="form-label">Nama Lengkap</label>
                </div>
                
                <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control" placeholder=" " value="{{ old('email') }}" required>
                    <label for="email" class="form-label">Email</label>
                </div>
                
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder=" " required>
                    <label for="password" class="form-label">Password</label>
                </div>
                
                <div class="password-requirements">
                    <h4>Password harus memenuhi:</h4>
                    <ul>
                        <li>Minimal 8 karakter</li>
                        <li>Mengandung huruf besar dan kecil</li>
                        <li>Mengandung angka</li>
                        <li>Mengandung karakter khusus</li>
                    </ul>
                </div>
                
                <div class="form-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder=" " required>
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                </div>
                
                <div class="terms">
                    Dengan mendaftar, Anda menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> kami.
                </div>
                
                <button type="submit" class="btn">Daftar Sekarang</button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
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

            // Validasi password real-time
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            
            function validatePassword() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (confirmPassword && password !== confirmPassword) {
                    confirmPasswordInput.style.borderColor = 'var(--danger)';
                } else if (confirmPassword) {
                    confirmPasswordInput.style.borderColor = 'var(--success)';
                } else {
                    confirmPasswordInput.style.borderColor = '';
                }
            }
            
            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validatePassword);
        });
    </script>
</body>
</html>