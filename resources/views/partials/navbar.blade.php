@php
    $currentPath = request()->path();
    $isActive = function ($route) use ($currentPath) {
        if ($route === '/') {
            return $currentPath === '';
        }
        return $currentPath === ltrim($route, '/') || str_starts_with($currentPath, ltrim($route, '/') . '/');
    };
@endphp

<header class="navbar" id="navbar">
    <div class="nav-container">
        <a href="/" class="brand">
            <img class="logo" src="{{ asset('images/mcg.jpg') }}" alt="Muscle Core Gym logo">
            <span class="brand-text">Muscle Core<span class="accent">Gym</span></span>
        </a>

        <nav class="nav-menu" id="nav-menu" aria-label="Main navigation">
            <a href="/" class="nav-link{{ $isActive('/') ? ' active' : '' }}">Home</a>
            @auth
                @if(Auth::user()->role === 'customer')
                    <a href="{{ route('account.dashboard') }}" class="nav-link{{ $isActive('account/dashboard') ? ' active' : '' }}">Dashboard</a>
                @endif
                @if(Auth::user()->role === 'trainer')
                    <a href="{{ route('trainer.dashboard') }}" class="nav-link{{ $isActive('trainer/dashboard') ? ' active' : '' }}">Dashboard</a>
                @endif
            @endauth
            <a href="/services" class="nav-link{{ $isActive('services') ? ' active' : '' }}">Services</a>
            <a href="/whyus" class="nav-link{{ $isActive('whyus') ? ' active' : '' }}">Why Us</a>
            <a href="/contact" class="nav-link{{ $isActive('contact') ? ' active' : '' }}">Contact</a>

            @guest
                <div class="nav-actions">
                    <a href="{{ route('account.login') }}" class="nav-login">Login</a>
                    <a href="{{ route('account.register') }}" class="btn btn-gold btn-sm">Sign Up</a>
                </div>
            @else
                <div class="nav-actions">
                    <a href="{{ route('account.logout') }}" class="btn btn-ghost btn-sm">Logout</a>
                </div>
            @endauth
        </nav>

        <button class="nav-toggle" id="nav-toggle" aria-label="Toggle menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>
<div class="nav-backdrop" id="nav-backdrop"></div>
