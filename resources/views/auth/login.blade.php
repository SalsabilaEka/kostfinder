<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #F9EDE3;
            font-family: sans-serif;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-form {
            background-color: #B3A99E;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
            /* Memberikan jarak antara logo dan form */
        }

        .logo {
            width: 200px;
            height: 80px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            color: #FAF6EF;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 0.5rem;
            border: none;
            border-radius: 0.375rem;
            background-color: #3F3530;
            color: #B3A99E;
            outline: none;
        }

        .form-input:focus {
            border: 2px solid #4D403A;
        }

        .error-text {
            color: #E6C491;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .form-remember {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .checkbox {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
            accent-color: #E6C491;
        }

        .checkbox-label {
            color: #FAF6EF;
            font-size: 0.9rem;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .link {
            color: #4D403A;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        .btn-submit {
            background-color: #4D403A;
            color: #e4cfc5;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #29241e;
        }

        .form-footer {
            text-align: center;
            margin-top: 1rem;
        }

        /* Media Queries for Responsive Design */
        @media (max-width: 900px) {
            .login-form {
                padding: 1.5rem;
                width: 100%;
                max-width: 70%;
            }

            .logo {
                max-width: 300px;
            }

            .form-input {
                padding: 0.65rem;
            }

            .btn-submit {
                padding: 0.65rem 1rem;
                max-width: 100px;
            }
        }
        @media (max-width: 768px) {
            .login-form {
                padding: 1.5rem;
                width: 100%;
                max-width: 70%;
            }

            .logo {
                max-width: 200px;
            }

            .form-input {
                padding: 0.65rem;
            }

            .btn-submit {
                padding: 0.65rem 1rem;
                max-width: 100px;
            }
        }

        @media (max-width: 480px) {
            .main-container {
                padding: 0.5rem;
            }

            .login-form {
                padding: 1.25rem;
                border-radius: 0.75rem;
                width: 100%;
                max-width: 70%;
            }

            .logo-container {
                margin-bottom: 1rem;
            }

            .logo {
                max-width: 200px;
            }

            .form-label {
                font-size: 0.9rem;
            }

            .form-input {
                padding: 0.6rem;
                font-size: 0.9rem;
            }

            .checkbox-label {
                font-size: 0.85rem;
            }

            .btn-submit {
                padding: 0.6rem;
                font-size: 0.9rem;
            }

            .link {
                font-size: 0.8rem;
            }

            .form-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .btn-submit {
                max-width: 100%;
                width: 100%;
            }
        }

        @media (max-width: 320px) {
            .login-form {
                padding: 1rem;
            }

            .logo {
                max-width: 180px;
            }

            .form-input {
                padding: 0.5rem;
            }
        }
    </style>
</head>


<body>

    <div class="main-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="{{ asset('assets/img/logo-kf.svg') }}" alt="Logo" class="logo">
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="form-input" placeholder="Masukkan email" />
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Kata sandi</label>
                <input id="password" name="password" type="password" required class="form-input"
                    placeholder="Masukkan kata sandi" />
                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-remember">
                <input id="remember_me" type="checkbox" name="remember" class="checkbox">
                <label for="remember_me" class="checkbox-label">Ingatkan saya</label>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link">Lupa kata sandi?</a>
                @endif
                <button href="{{ route('index') }}" type="submit" class="btn-submit">Masuk</button>
            </div>

            <!-- Register -->
            <div class="form-footer">
                <a href="{{ route('register') }}" class="link">Tidak punya akun? Daftar di sini</a>
            </div>
        </form>
    </div>
    </div>
</body>
</html>
