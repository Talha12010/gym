<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Muscle Core Gym</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-body">
        <img class="auth-bg" src="{{ asset('images/GYM.jpg') }}" alt="" aria-hidden="true">
        <div class="auth-overlay" aria-hidden="true"></div>

        <div class="auth-wrap">
            <a href="/" class="auth-brand">
                <img src="{{ asset('images/mcg.jpg') }}" alt="Muscle Core Gym logo">
                <span class="auth-brand-name">Muscle Core<span class="accent">Gym</span></span>
            </a>

            <div class="auth-card">
                <h1 class="auth-title">Welcome Back</h1>
                <p class="auth-sub">One login for members, trainers &amp; admins we'll take you to the right dashboard</p>

                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif

                <form action="{{ route('account.authenticate') }}" method="post">
                    @csrf

                    <div class="auth-field">
                        <label for="email">Email</label>
                        <input type="text" value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror"
                            name="email" id="email" placeholder="you@example.com">
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

                    <button class="btn btn-gold auth-submit" type="submit">Log In Now</button>
                </form>

                <div class="auth-divider">New here?</div>

                <div class="auth-links">
                    <a href="{{ route('account.register') }}" class="gold">Create a member account</a>
                    <a href="{{ route('trainer.register') }}">Create an account for trainers</a>
                    <a href="{{ route('auth.resetPassword') }}">Reset password</a>
                </div>
            </div>

            <a href="/" class="auth-home">← Back to home</a>
        </div>
    </div>
</body>
</html>
