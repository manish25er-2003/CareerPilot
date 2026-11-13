<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Login to CareerPilot AI and manage your job search, resume, and interview progress with AI-powered insights.">
    <meta name="theme-color" content="#111827">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <title>{{ config('app.name', 'CareerPilot AI') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="auth-shell">
    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-brand">
                <div class="brand-mark">CP</div>
                <div><span>Career</span>Pilot AI</div>
            </div>
            <div class="auth-body">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-password-toggle]').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = document.getElementById(button.getAttribute('data-target'));
                if (!input) return;
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                button.textContent = isPassword ? 'Hide' : 'Show';
            });
        });
    </script>
</body>

</html>