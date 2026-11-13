<nav x-data="{ open: false }" class="navbar navbar-expand-lg sticky-top" style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px); border-bottom: 1px solid rgba(17,24,39,0.08);">
    <div class="container py-2">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <span style="width: 11px; height: 11px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6, #4f46e5); display: inline-block; box-shadow: 0 0 0 6px rgba(124,77,255,0.12);"></span>
            <span class="text-primary-custom">Career</span>Pilot AI
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#accountNav" aria-controls="accountNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="accountNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile.index') }}">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('skills.index') }}">Skills</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('resumes.index') }}">Resumes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a></li>
                <li class="nav-item ms-lg-2">
                    <div class="dropdown">
                        <button class="btn btn-outline-custom dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 mt-2">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}">Account Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Log out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>