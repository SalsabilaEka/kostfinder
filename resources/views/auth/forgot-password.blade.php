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

        .forgot-form {
            background-color: #B3A99E;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            position: relative;
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

        .info-text {
            color: #FAF6EF;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
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

        .link {
            color: #4D403A;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        /* Toast Notification Styles */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4D403A;
            color: #FAF6EF;
            padding: 15px 25px;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: flex;
            align-items: center;
            transform: translateX(150%);
            transition: transform 0.3s ease-in-out;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            background-color: #3A5A40;
        }

        .toast.error {
            background-color: #9E2A2B;
        }

        .toast-icon {
            margin-right: 10px;
            font-size: 20px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    </style>

    <div class="main-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="{{ asset('assets/img/logo-kf.svg') }}" alt="Logo" class="logo">
        </div>

        <!-- Forgot Password Form -->
        <form method="POST" action="{{ $isDirectReset ?? false ? route('password.direct.update') : route('password.email') }}" class="forgot-form" id="passwordResetForm">
            @csrf

            <div class="info-text">
                @if($isDirectReset ?? false)
                    {{ __('Atur ulang kata sandi Anda dengan benar. Masukkan email dan kata sandi baru Anda di halaman ini.') }}
                @else
                    {{ __('Forgot your password? No problem. Just let us know your email...') }}
                @endif
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus />
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            @if($isDirectReset ?? false)
                <!-- New Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Kata sandi baru</label>
                    <input id="password" class="form-input" type="password" name="password" required />
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi kata sandi baru</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required />
                </div>
            @endif

            <div class="form-actions">
                <a href="{{ route('login') }}" class="link">Kembali ke halaman login</a>
                <button type="submit" class="btn-submit" id="submitBtn">
                    @if($isDirectReset ?? false)
                        {{ __('Atur ulang kata sandi') }}
                    @else
                        {{ __('Email Password Reset Link') }}
                    @endif
                </button>
            </div>
        </form>
    </div>

    <!-- Toast Notification Element -->
    <div id="toastNotification" class="toast">
        <span class="toast-icon">✓</span>
        <span id="toastMessage">Password reset link has been sent to your email!</span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('passwordResetForm');
            const submitBtn = document.getElementById('submitBtn');
            const toast = document.getElementById('toastNotification');
            const toastMessage = document.getElementById('toastMessage');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Memproses...';

                // Simulate form submission (replace with actual form submission)
                setTimeout(() => {
                    // Show toast notification
                    showToast('Password reset link has been sent to your email!', 'success');

                    // Reset form and button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = `{{ $isDirectReset ?? false ? __('Reset Password') : __('Email Password Reset Link') }}`;

                    // Optional: Actually submit the form after showing toast
                    form.submit();
                }, 1500);
            });

            function showToast(message, type = 'success') {
                toast.className = 'toast ' + type;
                toastMessage.textContent = message;
                toast.classList.add('show');

                // Hide toast after 5 seconds
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 5000);
            }

            // For demo purposes - handle success/error messages from server
            @if(session('status'))
                showToast("{{ session('status') }}", 'success');
            @endif

            @if($errors->any())
                showToast("{{ $errors->first() }}", 'error');
            @endif
        });
    </script>
</div>
