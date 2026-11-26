<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="CareerPilot AI helps you manage job applications, resumes, interviews, and career growth in one dashboard.">
    <meta name="theme-color" content="#111827">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <title>{{ config('app.name', 'CareerPilot AI') }}</title>
    @vite(['resources/css/pages/app.css', 'resources/js/app.js'])
</head>

<body class="premium-shell">
    <div class="min-vh-100" style="background: linear-gradient(180deg, #f5efe9 0%, #efe7df 100%);">
        @include('layouts.navigation')

        @isset($header)
        <header style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(17,24,39,0.08);">
            <div class="container py-5 px-3 px-md-4">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main class="py-4 py-lg-5">
            {{ $slot }}
        </main>

        @include('partials.toast-notifications')
    </div>
</body>

</html>