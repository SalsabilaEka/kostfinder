<div>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAF6EF;
            font-family: sans-serif;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .password-form {
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
        }

        .logo {
            width: 200px;
            height: 80px;
        }

        .info-text {
            color: #FAF6EF;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .status-message {
            color: #E6C491;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            text-align: center;
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

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
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
    </style>

    <div class="main-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="{{ asset('assets/img/logo-kf.svg') }}" alt="Logo" class="logo">
        </div>

        <!-- Password Reset Form -->
        <div class="password-form">
            <div class="info-text">
                {{ __('Silakan masukkan password baru untuk akun dengan email:') }} <strong>{{ $email }}</strong>
            </div>

            @if (session('error'))
                <div class="status-message" style="color: #ff6b6b;">
                    {{ session('error') }}
                </div>
            @endif

            <!-- resources/views/auth/reset-password.blade.php -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT') <!-- Ini akan mengubah method menjadi PUT -->

                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label for="password" class="form-label">Password Baru</label>
                    <input id="password" class="form-input" type="password" name="password" required />
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation"
                        required />
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        {{ __('Update Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
