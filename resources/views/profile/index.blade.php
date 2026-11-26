@extends('layouts.dashboard')

@section('title', 'My Profile | CareerPilot AI')

@section('content')
@php
$user = Auth::user();
$profile = $user?->profile;
$profileImage = $profile && $profile->profile_image ? Storage::url($profile->profile_image) : null;
$displayName = $user?->name ?: 'User';
$displayEmail = $user?->email ?: 'user@example.com';
$profileHeadline = $profile?->professional_headline ?: 'Career growth ready';
$profileScore = $profile?->profile_score ?? 0;
$initials = collect(explode(' ', trim($displayName)))
    ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
    ->take(2)
    ->implode('');
@endphp

<section class="my-profile-page" aria-labelledby="my-profile-title">
    <header class="my-profile-page__hero">
        <div class="my-profile-page__title">
            <span class="my-profile-page__title-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.8" />
                    <path d="M5 20v-1.5a7 7 0 0 1 14 0V20H5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                </svg>
            </span>
            <div>
                <h1 id="my-profile-title">My Profile</h1>
                <p>Manage your personal, professional, and career details.</p>
            </div>
        </div>
        <svg class="my-profile-page__wave" viewBox="0 0 700 100" preserveAspectRatio="none" fill="none" aria-hidden="true">
            <path d="M0 70c100 0 116-36 220-34 91 2 113 38 210 37 91-1 116-36 270-34v61H0V70Z" fill="url(#profile-wave-gradient)" />
            <defs>
                <linearGradient id="profile-wave-gradient" x1="0" y1="0" x2="700" y2="100" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#EEE9FF" stop-opacity=".08" />
                    <stop offset=".58" stop-color="#DCD3FF" stop-opacity=".8" />
                    <stop offset="1" stop-color="#EEE9FF" stop-opacity=".28" />
                </linearGradient>
            </defs>
        </svg>
    </header>

    <div class="my-profile-page__layout">
        <aside class="my-profile-account-card" aria-label="Account navigation">
            <h2>
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.8" />
                    <path d="M5 20v-1.5a7 7 0 0 1 14 0V20H5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                </svg>
                Account
            </h2>
            <nav class="my-profile-account-nav">
                <a href="#profile-information-form" class="is-active" aria-current="page">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.8" />
                        <path d="M5 20v-1.5a7 7 0 0 1 14 0V20H5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                    </svg>
                    Profile
                    <span aria-hidden="true">›</span>
                </a>
                <a href="{{ route('profile.edit') }}#security-settings">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 3 19 6v5c0 4.5-3 7.8-7 10-4-2.2-7-5.5-7-10V6l7-3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Security
                </a>
                <a href="{{ route('profile.edit') }}#delete-account">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 7h16m-10 4v6m4-6v6M6 7l1 14h10l1-14M9 7V4h6v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Delete Account
                </a>
            </nav>
        </aside>

        <div class="my-profile-page__main">
            <section class="my-profile-summary" aria-label="Profile overview">
                <div class="my-profile-summary__identity">
                    <span class="my-profile-avatar my-profile-avatar--summary">
                        @if ($profileImage)
                        <img src="{{ $profileImage }}" alt="{{ $displayName }}">
                        @else
                        {{ $initials ?: 'U' }}
                        @endif
                    </span>
                    <div class="my-profile-summary__text">
                        <h2>{{ $displayName }}</h2>
                        <p>{{ $profileHeadline }}</p>
                    </div>
                </div>

                <div class="my-profile-summary__completeness">
                    <div class="my-profile-summary__completeness-label">
                        <span>Profile Completeness</span>
                        <strong>{{ $profileScore }}%</strong>
                    </div>
                    <progress max="100" value="{{ $profileScore }}" aria-label="Profile completeness: {{ $profileScore }} percent">{{ $profileScore }}%</progress>
                </div>

                <a href="#profile-information-form" class="my-profile-button my-profile-button--outline">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m14 6 4 4M4 20l4-.8L19 8a2.1 2.1 0 0 0-3-3L5 16l-1 4Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Edit Profile
                </a>
            </section>

            <div class="my-profile-form-card" id="profile-information-form">
                @include('profile.partials.my-profile-information-form')
            </div>
        </div>
    </div>
</section>
@endsection
