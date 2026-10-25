<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Muscle Core Gym</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-body">
        <img class="auth-bg" src="{{ asset('images/gym2.jpg') }}" alt="" aria-hidden="true">
        <div class="auth-overlay" aria-hidden="true"></div>

        <div class="auth-wrap">
            <a href="/" class="auth-brand">
                <img src="{{ asset('images/mcg.jpg') }}" alt="Muscle Core Gym logo">
                <span class="auth-brand-name">Muscle Core<span class="accent">Gym</span></span>
            </a>

            <div class="auth-card">
                <h1 class="auth-title">Join The Gym</h1>
                <p class="auth-sub">Create your membership account in under a minute</p>

                <form action="{{ route('account.processregister') }}" method="POST">
                    @csrf

                    <div class="auth-field">
                        <label for="name">Full Name</label>
                        <input type="text" value="{{ old('name') }}"
                            class="@error('name') is-invalid @enderror"
                            name="name" id="name" placeholder="Your full name">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

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
                        <label for="password">Password</label>
                        <input type="password"
                            class="@error('password') is-invalid @enderror"
                            name="password" id="password" value="" placeholder="Create a password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password"
                            class="@error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" id="password_confirmation" value=""
                            placeholder="Repeat your password">
                        @error('password_confirmation')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="btn btn-gold auth-submit" type="submit">Register Now</button>
                </form>

                <div class="auth-divider">Already a member?</div>

                <div class="auth-links">
                    <a href="{{ route('account.login') }}" class="gold">Click to login</a>
                </div>
            </div>

            <a href="/" class="auth-home">← Back to home</a>
        </div>
    </div>
</body>
</html>
