@extends('layouts.dashboard')

@section('title', 'Edit profile | CareerPilot AI')

@section('content')
    @php
        $user = Auth::user();
        $profile = $user?->profile;
        $profileImage = $profile && $profile->profile_image ? Storage::url($profile->profile_image) : null;
        $displayName = $user?->name ?: 'User';
        $displayEmail = $user?->email ?: 'user@example.com';
        $profileHeadline = $profile?->professional_headline ?: 'Career growth ready';
        $initials = collect(explode(' ', trim($displayName)))
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->take(2)
            ->implode('');
    @endphp

    <div class="row g-4 profile-settings-layout">
        <div class="col-lg-3">
            <div class="card-soft settings-sidebar p-3">
                <div class="small text-uppercase text-secondary-custom fw-bold mb-3">Account</div>
                <div class="settings-nav">
                    <a href="{{ route('profile.index') }}" class="settings-nav-item">Profile</a>
                    <a href="{{ route('profile.edit') }}" class="settings-nav-item active">Security</a>
                    <a href="{{ route('profile.edit') }}" class="settings-nav-item">Delete account</a>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card-soft settings-summary p-4 p-lg-5 mb-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="dashboard-user-avatar" style="width: 68px; height: 68px; font-size: 1.05rem;">
                        @if ($profileImage)
                            <img src="{{ $profileImage }}" alt="{{ $displayName }}" class="img-fluid rounded-circle w-100 h-100 object-fit-cover">
                        @else
                            <span>{{ $initials ?: 'U' }}</span>
                        @endif
                    </div>
                    <div>
                        <div class="small text-uppercase text-secondary-custom fw-bold">Account</div>
                        <h3 class="fw-bold mb-1">{{ $displayName }}</h3>
                        <div class="text-secondary-custom">{{ $profileHeadline }}</div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-xl-7">
                    <div class="card-soft p-4 p-lg-5">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                <div class="col-12 col-xl-5">
                    <div class="card-soft p-4 p-lg-5">
                        @include('profile.partials.update-password-form')
                    </div>
                    <div class="card-soft p-4 p-lg-5 mt-4 border-danger-subtle">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
