<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Muscle Core Gym</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-body">
        <img class="auth-bg" src="{{ asset('images/gym6.jpg') }}" alt="" aria-hidden="true">
        <div class="auth-overlay" aria-hidden="true"></div>

        <div class="auth-wrap">
            <a href="/" class="auth-brand">
                <img src="{{ asset('images/mcg.jpg') }}" alt="Muscle Core Gym logo">
                <span class="auth-brand-name">Muscle Core<span class="accent">Gym</span></span>
            </a>

            <div class="auth-card">
                <h1 class="auth-title">Reset Password</h1>
                <p class="auth-sub">Verify your account and choose a new password</p>

                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif

                <form action="{{ route('auth.resetPassword') }}" method="POST">
                    @csrf

                    <div class="auth-field">
                        <label for="email">Email</label>
                        <input type="text" value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror"
                            name="email" id="email" placeholder="name@example.com">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="old_password">Old Password</label>
                        <input type="password"
                            class="@error('old_password') is-invalid @enderror"
                            name="old_password" id="old_password" placeholder="Your current password">
                        @error('old_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password">New Password</label>
                        <input type="password"
                            class="@error('password') is-invalid @enderror"
                            name="password" id="password" placeholder="Choose a new password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password"
                            class="@error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" id="password_confirmation"
                            placeholder="Repeat the new password">
                        @error('password_confirmation')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="btn btn-gold auth-submit" type="submit">Reset Password</button>
                </form>

                <div class="auth-divider">Need help?</div>

                <div class="auth-links">
                    <a href="{{ route('account.login') }}" class="gold">Back to login</a>
                    <a href="{{ route('auth.forgotPassword') }}">Send a reset link instead</a>
                </div>
            </div>

            <a href="/" class="auth-home">← Back to home</a>
        </div>
    </div>
</body>
</html>
