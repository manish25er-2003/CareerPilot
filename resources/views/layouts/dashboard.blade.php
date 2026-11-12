<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="CareerPilot AI">
    <meta name="description" content="CareerPilot AI dashboard for resumes, jobs, interviews, and career growth.">
    <title>@yield('title', 'CareerPilot Dashboard')</title>
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon-512.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon-192.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/careerpilot.css') }}">
</head>
@php
    $authUser = Auth::user();
    $profile = $authUser?->profile;
    $profileImage = $profile && $profile->profile_image ? \Illuminate\Support\Facades\Storage::url($profile->profile_image) : null;
    $userName = $authUser?->name ?: 'User';
    $userEmail = $authUser?->email ?: 'user@example.com';
    $userInitials = collect(explode(' ', trim($userName)))
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<body class="app-shell">
    <div class="container-fluid p-0">
        <div class="d-flex d-lg-none align-items-center justify-content-between px-3 py-3 border-bottom" style="background: rgba(255,255,255,0.7);">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none fw-bold text-dark">
                <span style="width: 10px; height: 10px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6, #4f46e5); display: inline-block;"></span>
                CareerPilot AI
            </a>
            <button class="btn btn-outline-custom" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                Menu
            </button>
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="mobileSidebarLabel">CareerPilot AI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <aside class="sidebar h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4 px-2">
                        <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none fw-bold fs-5" style="color: #ffffff;">
                            <span style="width: 10px; height: 10px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6, #4f46e5); display: inline-block;"></span>
                            CareerPilot AI
                        </a>
                    </div>

                    <div class="sidebar-profile mb-4">
                        <div class="dashboard-user-avatar">
                            @if ($profileImage)
                                <img src="{{ $profileImage }}" alt="{{ $userName }}" class="img-fluid rounded-circle">
                            @else
                                <span>{{ $userInitials ?: 'U' }}</span>
                            @endif
                        </div>
                        <div class="dashboard-user-meta">
                            <div class="dashboard-user-name">{{ $userName }}</div>
                            <div class="dashboard-user-email">{{ $userEmail }}</div>
                        </div>
                    </div>

                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="nav-link" href="{{ route('profile.index') }}">My Profile</a>
                        <a class="nav-link" href="{{ route('skills.index') }}">My Skills</a>
                        <a class="nav-link" href="{{ route('resumes.index') }}">My Resumes</a>
                        <a class="nav-link" href="{{ route('ai-analysis.index') }}">AI Resume Analysis</a>
                        <a class="nav-link" href="{{ route('jobs.index') }}">Job Applications</a>
                        <a class="nav-link" href="{{ route('interviews.index') }}">Interview Practice</a>
                        <a class="nav-link" href="{{ route('reports.overview') }}">Progress Reports</a>
                        <a class="nav-link" href="{{ route('contact') }}">Notifications</a>
                        <a class="nav-link" href="{{ route('home') }}">Settings</a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-4">
                            @csrf
                            <button type="submit" class="btn btn-outline-light w-100">Logout</button>
                        </form>
                    </nav>
                </aside>
            </div>
        </div>

        <div class="row g-0">
            <aside class="col-lg-2 sidebar d-none d-lg-block">
                <div class="d-flex align-items-center justify-content-between mb-4 px-2">
                    <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none fw-bold fs-5" style="color: #ffffff;">
                        <span style="width: 10px; height: 10px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6, #4f46e5); display: inline-block;"></span>
                        CareerPilot AI
                    </a>
                </div>

                <div class="sidebar-profile mb-4">
                    <div class="dashboard-user-avatar">
                        @if ($profileImage)
                            <img src="{{ $profileImage }}" alt="{{ $userName }}" class="img-fluid rounded-circle">
                        @else
                            <span>{{ $userInitials ?: 'U' }}</span>
                        @endif
                    </div>
                    <div class="dashboard-user-meta">
                        <div class="dashboard-user-name">{{ $userName }}</div>
                        <div class="dashboard-user-email">{{ $userEmail }}</div>
                    </div>
                </div>

                <nav class="nav flex-column">
                    <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="nav-link" href="{{ route('profile.index') }}">My Profile</a>
                    <a class="nav-link" href="{{ route('skills.index') }}">My Skills</a>
                    <a class="nav-link" href="{{ route('resumes.index') }}">My Resumes</a>
                    <a class="nav-link" href="{{ route('ai-analysis.index') }}">AI Resume Analysis</a>
                    <a class="nav-link" href="{{ route('jobs.index') }}">Job Applications</a>
                    <a class="nav-link" href="{{ route('interviews.index') }}">Interview Practice</a>
                    <a class="nav-link" href="{{ route('reports.overview') }}">Progress Reports</a>
                    <a class="nav-link" href="{{ route('contact') }}">Notifications</a>
                    <a class="nav-link" href="{{ route('home') }}">Settings</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-outline-light w-100">Logout</button>
                    </form>
                </nav>
            </aside>

            <main class="col-lg-10 content-area">
                <div class="d-flex justify-content-between align-items-center mb-4 gap-3 flex-wrap">
                    <div>
                        <h3 class="fw-bold mb-0">Good morning, {{ $userName }}</h3>
                    </div>
                    <div class="dashboard-header-actions d-flex align-items-center gap-2">
                        <button type="button" class="dashboard-notification-btn" aria-label="Notifications">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22a2.5 2.5 0 0 0 2.45-2h-4.9A2.5 2.5 0 0 0 12 22Zm7-6.5V11a7 7 0 1 0-14 0v4.5l-1.5 1.5V18h17v-1l-1.5-1.5Z"/></svg>
                        </button>
                        <div class="dropdown">
                            <button class="header-profile-btn dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="dashboard-user-avatar small-avatar">
                                    @if ($profileImage)
                                        <img src="{{ $profileImage }}" alt="{{ $userName }}" class="img-fluid rounded-circle">
                                    @else
                                        <span>{{ $userInitials ?: 'U' }}</span>
                                    @endif
                                </span>
                                <span class="header-profile-meta">
                                    <span class="header-profile-name">{{ $userName }}</span>
                                    <span class="header-profile-email">{{ $userEmail }}</span>
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 mt-2">
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">View profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
