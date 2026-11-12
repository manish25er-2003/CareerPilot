<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CareerPilot Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/careerpilot.css') }}">
</head>
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-0">Good morning, {{ Auth::user()->name }}</h3>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="badge bg-primary-custom px-3 py-2">{{ Auth::user()->role ?? 'user' }}</span>
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
