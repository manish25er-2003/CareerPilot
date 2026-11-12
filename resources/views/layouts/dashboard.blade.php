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
        <div class="row g-0">
            <aside class="col-lg-2 sidebar">
                <div class="d-flex align-items-center justify-content-between mb-4 px-2">
                    <a href="{{ route('home') }}" class="text-decoration-none text-white fw-bold fs-5">CareerPilot AI</a>
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
