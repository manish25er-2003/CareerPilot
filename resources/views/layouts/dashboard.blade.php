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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

$mobilePrimaryNav = [
['label' => 'Dashboard', 'route' => route('dashboard'), 'active' => request()->routeIs('dashboard'), 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true">
    <path d="M3 10.5 12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1v-9.5Z" />
</svg>'],
['label' => 'Jobs', 'route' => route('jobs.index'), 'active' => request()->routeIs('jobs.*'),'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true">
    <path d="M9 7V5.75A1.75 1.75 0 0 1 10.75 4h2.5A1.75 1.75 0 0 1 15 5.75V7h2.5A1.5 1.5 0 0 1 19 8.5v9A2.5 2.5 0 0 1 16.5 20h-9A2.5 2.5 0 0 1 5 17.5v-9A1.5 1.5 0 0 1 6.5 7H9Zm2-1.25V7h2V5.75a.75.75 0 0 0-.75-.75h-2.5a.75.75 0 0 0-.75.75Z" />
</svg>'],
['label' => 'Resume', 'route' => route('resumes.index'), 'active' => request()->routeIs('resumes.*'), 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true">
    <path d="M7 3.5A2.5 2.5 0 0 0 4.5 6v12A2.5 2.5 0 0 0 7 20.5h10A2.5 2.5 0 0 0 19.5 18V8.2a2.2 2.2 0 0 0-.64-1.56L15.36 3.14A2.2 2.2 0 0 0 13.8 2.5H7Zm8 2.2 2.7 2.7H15a1 1 0 0 1-1-1V5.7Zm-6.2 6.1h5.4a.8.8 0 1 1 0 1.6H8.8a.8.8 0 1 1 0-1.6Zm0 3h7.4a.8.8 0 1 1 0 1.6H8.8a.8.8 0 1 1 0-1.6Z" />
</svg>'],
['label' => 'More', 'route' => '#', 'active' => request()->routeIs('profile.*','skills.*','ai-analysis.*','interviews.*','reports.*','contact'), 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true">
    <path d="M5 12a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Z" />
</svg>']
];

$mobileMoreNav = [
['label' => 'My Profile', 'route' => route('profile.index'), 'active' => request()->routeIs('profile.*'), 'icon' => '👤'],
['label' => 'My Skills', 'route' => route('skills.index'), 'active' => request()->routeIs('skills.*'), 'icon' => '✨'],
['label' => 'Interview Practice', 'route' => route('interviews.index'), 'active' => request()->routeIs('interviews.*'), 'icon' => '🎤'],
['label' => 'AI Resume Analysis', 'route' => route('ai-analysis.index'), 'active' => request()->routeIs('ai-analysis.*'), 'icon' => '🧠'],
['label' => 'Progress Reports', 'route' => route('reports.overview'), 'active' => request()->routeIs('reports.*'), 'icon' => '📊'],
['label' => 'Notifications', 'route' => route('contact'), 'active' => request()->routeIs('contact'), 'icon' => '🔔'],
['label' => 'Settings', 'route' => route('profile.edit'), 'active' => request()->routeIs('profile.edit'), 'icon' => '⚙️'],
['label' => 'Help & Support', 'route' => route('contact'), 'active' => request()->routeIs('contact'), 'icon' => '💬'],
];
@endphp

<body class="app-shell">
    <div class="jobflow-dashboard-shell">
        <aside class="jobflow-sidebar">
            <div class="jobflow-logo">
                <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none" style="color: #ffffff;">
                    <span class="jobflow-logo-mark">✦</span>
                    <span>CareerPilot AI</span>
                </a>
            </div>

            <div class="jobflow-user-chip">
                <span class="jobflow-user-avatar">
                    @if ($profileImage)
                    <img src="{{ $profileImage }}" alt="{{ $userName }}" class="img-fluid rounded-circle">
                    @else
                    {{ $userInitials ?: 'U' }}
                    @endif
                </span>
                <div>
                    <strong>{{ $userName }}</strong>
                    <small>{{ $userEmail }}</small>
                </div>
            </div>

            <nav class="jobflow-nav" aria-label="Sidebar navigation">
                <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="{{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">My Profile</a>
                <a class="{{ request()->routeIs('skills.*') ? 'active' : '' }}" href="{{ route('skills.index') }}">My Skills</a>
                <a class="{{ request()->routeIs('resumes.*') ? 'active' : '' }}" href="{{ route('resumes.index') }}">My Resumes</a>
                <a class="{{ request()->routeIs('jobs.*') ? 'active' : '' }}" href="{{ route('jobs.index') }}">Job Applications</a>
                <a class="{{ request()->routeIs('interviews.*') ? 'active' : '' }}" href="{{ route('interviews.index') }}">Interview Practice</a>
                <a class="{{ request()->routeIs('ai-analysis.*') ? 'active' : '' }}" href="{{ route('ai-analysis.index') }}">AI Analysis</a>
                <a class="{{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.overview') }}">Progress Reports</a>
                <a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Notifications</a>
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Settings</a>
            </nav>

            <div id="installAppCard" class="install-app-card" hidden>
                <div class="install-app-card__panel">
                    <button type="button" class="install-app-card__dismiss" id="dismissInstallAppCard" aria-label="Dismiss install app card">×</button>
                    <div class="install-app-card__top">
                        <div class="install-app-card__logo">
                            <img src="{{ asset('favicon-192.png') }}" alt="CareerPilot AI logo">
                        </div>
                        <div class="install-app-card__meta">
                            <span class="install-app-card__eyebrow">GET THE APP</span>
                            <h6>Install CareerPilot AI</h6>
                        </div>
                    </div>
                    <p class="install-app-card__description">Get faster access to your career tools. Install the app on your device.</p>
                    <button type="button" id="installAppBtn" class="install-app-card__button" aria-label="Install CareerPilot AI">
                        <span class="install-app-card__button-icon" aria-hidden="true">↓</span>
                        Install app
                    </button>
                    <div class="install-app-card__footer">Quick access, anytime.</div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">Logout</button>
            </form>
        </aside>

        <main class="jobflow-main-panel">
            <div class="jobflow-header-bar">
                <div class="jobflow-title-wrap">
                    <div class="jobflow-icon-badge">✦</div>
                    <div>
                        <h2>{{ request()->routeIs('admin.dashboard') ? 'Admin Overview' : 'Your Career Journey' }}</h2>
                        <p>{{ request()->routeIs('admin.dashboard') ? 'Monitor growth, users, and platform performance.' : 'Track your applications, interviews, and career momentum.' }}</p>
                    </div>
                </div>

                <div class="jobflow-header-actions">
                    <div class="jobflow-search" aria-label="Search opportunities">
                        <span>⌕</span>
                        <input type="text" value="" aria-label="Search" placeholder="Search opportunities, tools...">
                    </div>
                    <button type="button" class="jobflow-notification-btn" aria-label="Notifications">🔔</button>
                    <div class="dropdown">
                        <button class="jobflow-user-panel dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="jobflow-user-avatar small">
                                @if ($profileImage)
                                <img src="{{ $profileImage }}" alt="{{ $userName }}" />
                                @else
                                {{ $userInitials ?: 'U' }}
                                @endif
                            </span>
                            <div class="jobflow-user-mini-card">
                                <strong>{{ $userName }}</strong>
                                <small>{{ $userEmail }}</small>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 mt-2">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}">View profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>

    @include('partials.footer')

    <nav class="mobile-bottom-nav" aria-label="Mobile navigation">
        @foreach ($mobilePrimaryNav as $item)
        @if ($item['label'] === 'More')
        <button type="button" class="mobile-bottom-nav__item {{ $item['active'] ? 'active' : '' }}" data-mobile-more-trigger aria-label="More navigation" aria-expanded="false">
            <span class="mobile-bottom-nav__icon">{!! $item['icon'] !!}</span>
            <span class="mobile-bottom-nav__label">{{ $item['label'] }}</span>
        </button>
        @else
        <a href="{{ $item['route'] }}" class="mobile-bottom-nav__item {{ $item['active'] ? 'active' : '' }}" aria-label="{{ $item['label'] }}">
            <span class="mobile-bottom-nav__icon">{!! $item['icon'] !!}</span>
            <span class="mobile-bottom-nav__label">{{ $item['label'] }}</span>
        </a>
        @endif
        @endforeach
    </nav>

    <div class="mobile-more-backdrop" id="mobileMoreBackdrop" data-close-mobile-more></div>

    <div class="mobile-more-sheet" id="mobileMoreSheet" role="dialog" aria-modal="true" aria-labelledby="mobileMoreTitle">
        <div class="mobile-more-sheet__header">
            <h3 id="mobileMoreTitle">More</h3>
            <button type="button" class="mobile-more-close" data-close-mobile-more aria-label="Close menu">✕</button>
        </div>
        <div class="mobile-more-sheet__content">
            @foreach ($mobileMoreNav as $item)
            <a href="{{ $item['route'] }}" class="mobile-more-sheet__item {{ $item['active'] ? 'is-active' : '' }}">
                <span class="mobile-more-sheet__icon">{{ $item['icon'] }}</span>
                <span>{{ $item['label'] }}</span>
            </a>
            @endforeach
            <form method="POST" action="{{ route('logout') }}" class="mobile-more-sheet__form">
                @csrf
                <button type="submit" class="mobile-more-sheet__item mobile-more-sheet__item--logout">
                    <span class="mobile-more-sheet__icon">⎋</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const installCard = document.getElementById('installAppCard');
            const installBtn = document.getElementById('installAppBtn');
            const dismissBtn = document.getElementById('dismissInstallAppCard');
            const installKey = 'careerpilot-install-dismissed';

            if (installCard && installBtn) {
                const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
                const wasDismissed = localStorage.getItem(installKey) === '1';

                if (isStandalone || wasDismissed) {
                    installCard.hidden = true;
                } else {
                    installCard.hidden = false;
                }

                let deferredPrompt = null;

                const showManualInstall = function() {
                    installBtn.innerHTML = '<span class="install-app-card__button-icon" aria-hidden="true">☰</span> Use browser menu';
                    installBtn.setAttribute('title', 'Use your browser menu and choose Add to Home Screen');
                    installBtn.dataset.mode = 'manual';
                    installCard.dataset.mode = 'manual';
                };

                const hideInstallCard = function() {
                    installCard.hidden = true;
                    localStorage.setItem(installKey, '1');
                };

                if (dismissBtn) {
                    dismissBtn.addEventListener('click', hideInstallCard);
                }

                installBtn.addEventListener('click', function() {
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        deferredPrompt.userChoice.finally(function() {
                            deferredPrompt = null;
                        });
                        return;
                    }

                    showManualInstall();
                });

                window.addEventListener('beforeinstallprompt', function(event) {
                    event.preventDefault();
                    deferredPrompt = event;
                    installBtn.innerHTML = '<span class="install-app-card__button-icon" aria-hidden="true">↓</span> Install app';
                    installBtn.removeAttribute('title');
                    delete installBtn.dataset.mode;
                    installCard.dataset.mode = 'prompt';
                });

                window.addEventListener('appinstalled', function() {
                    hideInstallCard();
                });

                if (!('beforeinstallprompt' in window) || window.matchMedia('(display-mode: standalone)').matches) {
                    showManualInstall();
                }
            }

            const trigger = document.querySelector('[data-mobile-more-trigger]');
            const sheet = document.getElementById('mobileMoreSheet');
            const backdrop = document.getElementById('mobileMoreBackdrop');
            const closeButtons = document.querySelectorAll('[data-close-mobile-more]');

            if (!trigger || !sheet || !backdrop) {
                return;
            }

            let startY = 0;
            let deltaY = 0;

            const openSheet = () => {
                sheet.classList.add('is-open');
                backdrop.classList.add('is-visible');
                trigger.setAttribute('aria-expanded', 'true');
                document.body.classList.add('mobile-more-open');
            };

            const closeSheet = () => {
                sheet.classList.remove('is-open');
                backdrop.classList.remove('is-visible');
                trigger.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('mobile-more-open');
                sheet.style.transform = '';
            };

            trigger.addEventListener('click', function() {
                const isOpen = sheet.classList.contains('is-open');
                isOpen ? closeSheet() : openSheet();
            });

            closeButtons.forEach(function(button) {
                button.addEventListener('click', closeSheet);
            });

            backdrop.addEventListener('click', closeSheet);

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeSheet();
                }
            });

            const pointerStart = function(event) {
                startY = event.touches ? event.touches[0].clientY : event.clientY;
                deltaY = 0;
            };

            const pointerMove = function(event) {
                if (!sheet.classList.contains('is-open')) {
                    return;
                }

                const currentY = event.touches ? event.touches[0].clientY : event.clientY;
                deltaY = currentY - startY;

                if (deltaY > 0) {
                    sheet.style.transform = 'translateY(' + deltaY + 'px)';
                }
            };

            const pointerEnd = function() {
                if (deltaY > 90) {
                    closeSheet();
                    return;
                }

                sheet.style.transform = '';
            };

            sheet.addEventListener('touchstart', pointerStart, {
                passive: true
            });
            sheet.addEventListener('touchmove', pointerMove, {
                passive: true
            });
            sheet.addEventListener('touchend', pointerEnd);
            sheet.addEventListener('mousedown', pointerStart);
            sheet.addEventListener('mousemove', pointerMove);
            sheet.addEventListener('mouseup', pointerEnd);

            sheet.querySelectorAll('a, button').forEach(function(element) {
                element.addEventListener('click', function() {
                    closeSheet();
                });
            });
        });
    </script>
</body>

</html>