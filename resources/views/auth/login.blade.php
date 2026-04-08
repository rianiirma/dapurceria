<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dapur Ceria</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }

        /* Floating Food Icons Animation */
        .floating-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .floating-icons span {
            position: absolute;
            font-size: 60px;
            animation: float 15s infinite ease-in-out;
            opacity: 0.3;
        }

        .floating-icons span:nth-child(1) { left: 10%; animation-delay: 0s; }
        .floating-icons span:nth-child(2) { left: 20%; animation-delay: 2s; font-size: 80px; }
        .floating-icons span:nth-child(3) { left: 40%; animation-delay: 4s; }
        .floating-icons span:nth-child(4) { left: 60%; animation-delay: 1s; font-size: 70px; }
        .floating-icons span:nth-child(5) { left: 80%; animation-delay: 3s; }
        .floating-icons span:nth-child(6) { left: 30%; animation-delay: 5s; font-size: 90px; }
        .floating-icons span:nth-child(7) { left: 70%; animation-delay: 6s; }

        @keyframes float {
            0%, 100% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            50% {
                transform: translateY(-20vh) rotate(180deg);
            }
        }

        /* Login Container */
        .login-container {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 50px 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            font-size: 80px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .logo h1 {
            font-size: 32px;
            background: linear-gradient(135deg, #F59E0B, #EF4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 10px;
        }

        .logo p {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #F59E0B;
            font-size: 20px;
        }

        .form-control {
            width: 100%;
            padding: 15px 15px 15px 50px;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            font-size: 15px;
            transition: all 0.3s;
            background: #f9f9f9;
        }

        .form-control:focus {
            outline: none;
            border-color: #F59E0B;
            background: white;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .forgot-link {
            color: #F59E0B;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 15px;
            background: linear-gradient(135deg, #F59E0B, #EF4444);
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(245, 158, 11, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #ddd;
        }

        .divider::before { left: 0; }
        .divider::after { right: 0; }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #999;
            font-size: 14px;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .register-link a {
            color: #F59E0B;
            font-weight: 700;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #fee;
            color: #c00;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #c00;
        }
    </style>
</head>
<body>
    <!-- Floating Food Icons -->
    <div class="floating-icons">
        <span>🍕</span>
        <span>🍔</span>
        <span>🍜</span>
        <span>🍰</span>
        <span>🍱</span>
        <span>🥗</span>
        <span>🍳</span>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <div class="logo-icon">🍳</div>
                <h1>Dapur Ceria</h1>
                <p>Masuk ke akun Anda</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    <strong>Oops!</strong> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-wrapper">
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="email" class="form-control" 
                               placeholder="masukkan@email.com" 
                               value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" name="password" class="form-control" 
                               placeholder="••••••••" required>
                    </div>
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Lupa Passwo