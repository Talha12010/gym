<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password Muscle Core Gym</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-body">
        <img class="auth-bg" src="{{ asset('images/gym5.jpg') }}" alt="" aria-hidden="true">
        <div class="auth-overlay" aria-hidden="true"></div>

        <div class="auth-wrap">
            <a href="/" class="auth-brand">
                <img src="{{ asset('images/mcg.jpg') }}" alt="Muscle Core Gym logo">
                <span class="auth-brand-name">Muscle Core<span class="accent">Gym</span></span>
            </a>

            <div class="auth-card">
                <h1 class="auth-title">Forgot Password</h1>
                <p class="auth-sub">Enter your email and we'll send you a reset link</p>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.forgotPassword') }}">
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

                    <button class="btn btn-gold auth-submit" type="submit">Send Reset Link</button>
                </form>

                <div class="auth-divider">Remembered it?</div>

                <div class="auth-links">
                    <a href="{{ route('account.login') }}" class="gold">Back to login</a>
                    <a href="{{ route('auth.resetPassword') }}">Reset password with old password</a>
                </div>
            </div>

            <a href="/" class="auth-home">← Back to home</a>
        </div>
    </div>
</body>
</html>
