<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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

        .register-form {
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
            width: 96%;
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
            color: #d40101;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
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


        /* Media Queries for Responsive Design */
   @media (max-width: 900px) {
            .register-form {
                padding: 1.5rem;
                width: 100%;
                max-width: 70%;
            }

            .logo {
                max-width: 300px;
            }

            .form-input {
                padding: 0.65rem;
                max-width: 96%;
            }

            .btn-submit {
                padding: 0.65rem 1rem;
                max-width: 100px;
            }
        }
        @media (max-width: 768px) {
            .register-form {
                padding: 1.5rem;
                width: 100%;
                max-width: 70%;
            }

            .logo {
                max-width: 200px;
            }

            .form-input {
                padding: 0.65rem;
                max-width: 94%;
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

            .register-form {
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
                max-width: 94%;
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
                max-width: 94%
                width: 100%;
            }
            .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
        }
        }

        @media (max-width: 320px) {
            .register-form {
                padding: 1rem;
            }

            .logo {
                max-width: 180px;
            }

            .form-input {
                padding: 0.5rem;
            }
            .btn-submit {
                max-width: 94%
                width: 100%;
            }
            .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
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

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input id="name"  class="form-input"  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                @error('name')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                @error('email')
                    <p class="error-text">Email sudah terdaftar</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Kata sandi</label>
                <input id="password" class="form-input"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                @error('password')
                    <p class="error-text">Kata sandi minimal berisi 9 karakter</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi kata sandi</label>
                <input id="password_confirmation" class="form-input"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <a href="{{ route('login') }}" class="link">
                    Sudah terdaftar?
                </a>
                <button type="submit" class="btn-submit">
                    Daftar
                </button>
            </div>
        </form>
    </div>

</body>
</html>
