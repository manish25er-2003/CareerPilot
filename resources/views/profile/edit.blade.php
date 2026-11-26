@extends('layouts.dashboard')

@section('title', 'Settings | CareerPilot AI')

@section('content')
@php
$user = Auth::user();
$profile = $user?->profile;
$profileImage = $profile && $profile->profile_image ? Storage::url($profile->profile_image) : null;
$displayName = $user?->name ?: 'User';
$initials = collect(explode(' ', trim($displayName)))
->map(fn ($part) => strtoupper(substr($part, 0, 1)))
->take(2)
->implode('');
@endphp

<section class="settings-page" aria-labelledby="settings-page-title">
    <header class="settings-page__heading">
        <div>
            <span class="settings-page__eyebrow">Account preferences</span>
            <h1 id="settings-page-title">Settings</h1>
            <p>Manage your profile and keep your account secure.</p>
        </div>
    </header>

    <nav class="settings-tabs" aria-label="Settings sections">
        <a class="settings-tab is-active" href="#profile-information" aria-current="page">Profile</a>
        <a class="settings-tab" href="#security-settings">Security</a>
        <a class="settings-tab" href="#delete-account">Delete account</a>
    </nav>

    <div class="settings-grid">
        <div class="settings-card settings-profile-card" id="profile-information">
            @include('profile.partials.update-profile-information-form')
        </div>

        <aside class="settings-side-column">
            <div class="settings-card settings-password-card" id="security-settings">
                @include('profile.partials.update-password-form')
            </div>

            <div class="settings-card settings-danger-card" id="delete-account">
                @include('profile.partials.delete-user-form')
            </div>
        </aside>
    </div>
</section>
@endsection
