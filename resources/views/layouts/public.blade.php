<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="CareerPilot AI helps job seekers track applications, improve resumes, practice interviews, and grow faster with AI-powered insights.">
    <meta name="keywords" content="AI resume builder, job tracking, interview prep, career growth, career dashboard, AI career assistant">
    <meta name="theme-color" content="#0f172a">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="CareerPilot AI">
    <meta property="og:title" content="CareerPilot AI | AI Career Growth Platform">
    <meta property="og:description" content="Track applications, improve your resume, practice interviews, and stay organized with CareerPilot AI.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('favicon-512.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon-512.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon-192.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <title>@yield('title', 'CareerPilot AI | AI Career Growth Platform')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg premium-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span class="brand-dot"></span>
                <span class="text-primary-custom">Career</span>Pilot AI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto gap-lg-3">
                    <li class="nav-item"><a class="nav-link text-secondary-custom" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary-custom" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary-custom" href="{{ route('features') }}">Features</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary-custom" href="{{ route('how-it-works') }}">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary-custom" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="d-flex gap-2 nav-actions ms-auto">
                @auth
                <a href="{{ route('dashboard') }}" class="btn btn-outline-custom">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline-custom">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary-custom text-white">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <nav class="public-mobile-bottom-nav" aria-label="Mobile navigation">
        <a href="{{ route('home') }}" class="public-mobile-bottom-nav__item {{ request()->routeIs('home') ? 'active' : '' }}">
            <span>🏠</span>
            <small>Home</small>
        </a>
        <a href="{{ route('features') }}" class="public-mobile-bottom-nav__item {{ request()->routeIs('features') ? 'active' : '' }}">
            <span>✨</span>
            <small>Features</small>
        </a>
        @auth
        <a href="{{ route('dashboard') }}" class="public-mobile-bottom-nav__item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span>📊</span>
            <small>Dash</small>
        </a>
        @else
        <a href="{{ route('login') }}" class="public-mobile-bottom-nav__item {{ request()->routeIs('login') ? 'active' : '' }}">
            <span>🔐</span>
            <small>Login</small>
        </a>
        @endauth
        <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="public-mobile-bottom-nav__item {{ request()->routeIs('register') ? 'active' : '' }}">
            <span>{{ auth()->check() ? '🚀' : '➕' }}</span>
            <small>{{ auth()->check() ? 'Open' : 'Join' }}</small>
        </a>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>