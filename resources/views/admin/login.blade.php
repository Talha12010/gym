<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Muscle Core Gym</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-body">
        <img class="auth-bg" src="{{ asset('images/gym4.jpg') }}" alt="" aria-hidden="true">
        <div class="auth-overlay" aria-hidden="true"></div>

        <div class="auth-wrap">
            <a href="/" class="auth-brand">
                <img src="{{ asset('images/mcg.jpg') }}" alt="Muscle Core Gym logo">
                <span class="auth-brand-name">Muscle Core<span class="accent">Gym</span></span>
            </a>

            <div class="auth-card">
                <h1 class="auth-title">Admin Login</h1>
                <p class="auth-sub">Restricted access authorized personnel only</p>

                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif

                <form class="new" action="{{ route('admin.authenticate') }}" method="POST">
                    @csrf

                    <div class="auth-field">
                        <label for="email">Username</label>
                        <input type="text" value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror"
                            name="email" id="email" placeholder="Admin username">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password">Password</label>
                        <input type="password"
                            class="@error('password') is-invalid @enderror"
                            name="password" id="password" value="" placeholder="Your password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="auth-check" for="remember">
                        <input type="checkbox" id="remember" name="remember">
                        Remember me
                    </label>

                    <button class="btn btn-gold auth-submit" type="submit">Login</button>
                </form>

                <div class="auth-divider">Not an admin?</div>

                <div class="auth-links">
                    <a href="{{ route('account.register') }}">Create a member account</a>
                    <a href="{{ route('account.login') }}" class="gold">Member / Trainer login</a>
                </div>
            </div>

            <a href="/" class="auth-home">← Back to home</a>
        </div>
    </div>
</body>
</html>
