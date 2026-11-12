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
    <link rel="stylesheet" href="{{ asset('css/careerpilot.css') }}">
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
                <div class="d-flex gap-2 nav-actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-custom">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-custom">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary-custom text-white">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-navy text-white py-5 mt-5 premium-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">CareerPilot AI</h5>
                    <p class="text-white-50">Your AI career growth partner for smarter resumes, interviews, and applications.</p>
                </div>
                <div class="col-lg-2">
                    <h6 class="fw-semibold mb-3">Company</h6>
                    <div class="d-grid gap-2">
                        <a href="{{ route('about') }}" class="footer-link text-decoration-none">About</a>
                        <a href="{{ route('features') }}" class="footer-link text-decoration-none">Features</a>
                        <a href="{{ route('contact') }}" class="footer-link text-decoration-none">Contact</a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h6 class="fw-semibold mb-3">Resources</h6>
                    <div class="d-grid gap-2">
                        <a href="{{ route('how-it-works') }}" class="footer-link text-decoration-none">How it Works</a>
                        <a href="{{ route('privacy-policy') }}" class="footer-link text-decoration-none">Privacy Policy</a>
                        <a href="{{ route('terms-and-conditions') }}" class="footer-link text-decoration-none">Terms</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h6 class="fw-semibold mb-3">Support</h6>
                    <p class="text-white-50 mb-1">hello@careerpilot.ai</p>
                    <p class="text-white-50">+1 (555) 123-4567</p>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center text-white-50 small">© {{ date('Y') }} CareerPilot AI. All rights reserved.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
