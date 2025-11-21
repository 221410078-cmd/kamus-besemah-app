<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ke Kamus Modern</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Variabel CSS dari kode ASLI Anda */
        :root {
            --color-primary: #0d2b53; /* Biru terang */
            --color-accent: #00bcd4;
            --color-bg-light: #f4f7f6; /* Latar belakang body/luar */
            --color-card-bg: #508ba0; /* Latar belakang form (putih) */
            --color-text-dark: #333333;
            --color-text-label: #ffffff;
            --color-table-border: #e6dede;
            --color-overlay: rgba(92, 119, 155, 0.7); /* Overlay biru transparan */
        }

        /* BODY - Menggunakan gaya dashboard yang bersih */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(img/batik.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }

        /* Overlay untuk meningkatkan keterbacaan */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--color-overlay);
            z-index: -1;
        }

        /* FORM CONTAINER - Menggunakan gaya Card Modern */
        .login-container {
            background-color: var(--color-card-bg);
            padding: 40px;
            border-radius: 10px; /* Sudut melengkung */
            /* Bayangan Card yang elegan dari CSS dashboard */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); 
            width: 380px; 
            box-sizing: border-box;
            border-top: 5px solid var(--color-primary); /* Garis atas pemisah yang keren */
            text-align: center; /* Menengahkan konten di dalam container */
            position: relative;
            overflow: hidden;
        }

        /* Logo styling */
        .logo-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        /* Judul Form */
        .form-title {
            font-size: 1.8em;
            font-weight: 700;
            color: var(--color-text-label); /* Menggunakan warna primary */
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase; /* Buat judul lebih menonjol */
            letter-spacing: 0.5px;
        }

        /* Grup input */
        .form-group {
            margin-bottom: 20px;
            text-align: left; /* Teks label tetap rata kiri */
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 0.95em;
            color: var(--color-text-label); 
        }

        /* Input Text dan Select - Menggunakan gaya .data-form input */
        .form-group input[type="text"], 
        .form-group input[type="password"],
        .form-group select {
            width: 100%;
            padding: 12px 12px;
            border: 2px solid var(--color-table-border); /* Border standar */
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
            transition: all 0.3s;
            background-color: var(--color-bg-light); /* Latar belakang input sedikit abu-abu */
            font-family: 'Inter', sans-serif;
            padding-right: 45px; /* Memberikan ruang untuk ikon mata */
        }

        /* Efek Focus yang elegan */
        .form-group input:focus, .form-group select:focus {
            border-color: var(--color-primary); /* Border berubah menjadi warna primary saat fokus */
            outline: none;
            box-shadow: 0 0 0 3px rgba(13, 43, 83, 0.2);
            background-color: #ffffff;
        }

        /* Tombol Login - Menggunakan gaya .save-btn */
        .login-btn {
            background-color: var(--color-primary);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            display: block;
            width: 100%; /* Tombol penuh */
            margin-top: 30px;
            font-size: 1em;
            font-family: 'Inter', sans-serif;
        }
        
        .login-btn:hover { 
            background-color: #0056b3; 
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Pesan sukses dan error */
        .message {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 600;
        }

        .success-message {
            background-color: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
            border: 1px solid #2ecc71;
        }

        .error-message {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }

        /* Responsif untuk perangkat kecil */
        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 30px 25px;
                margin: 20px;
            }
            
            .logo {
                width: 100px;
                height: 100px;
            }
            
            .form-title {
                font-size: 1.6em;
                margin-bottom: 25px;
            }
        }

        /* Animasi loading untuk tombol */
        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #ffffff;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Styling untuk toggle password */
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-10%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 1.2em;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .toggle-password:hover {
            color: var(--color-primary);
            background-color: rgba(13, 43, 83, 0.1);
        }

        .toggle-password:focus {
            outline: none;
            color: var(--color-primary);
            background-color: rgba(13, 43, 83, 0.1);
        }
    </style>

</head>
<body>

    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('img/44.png') }}" alt="Logo Kamus Modern" class="logo">
        </div>
        
        <h2 class="form-title">KAMUS BAHASA BESEMAH</h2>

        @if ($errors->any())
            <div class="message error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username Anda" required>
            </div>
            
            <div class="form-group password-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                <button type="button" class="toggle-password" id="togglePassword">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </button>
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>

</body>
</html>
