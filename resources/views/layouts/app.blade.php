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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/careerpilot.css') }}">
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
        </div>
    </body>
</html>
