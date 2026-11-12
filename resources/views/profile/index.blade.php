@extends('layouts.dashboard')

@section('title', 'Profile settings | CareerPilot AI')

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

    <div class="row g-4 profile-settings-layout">
        <div class="col-lg-3">
            <div class="card-soft settings-sidebar p-3">
                <div class="small text-uppercase text-secondary-custom fw-bold mb-3 letter-spacing">Account</div>
                <div class="settings-nav">
                    <a href="{{ route('profile.index') }}" class="settings-nav-item active">Profile</a>
                    <a href="{{ route('profile.edit') }}" class="settings-nav-item">Security</a>
                    <a href="{{ route('profile.edit') }}" class="settings-nav-item">Delete account</a>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card-soft settings-summary p-4 p-lg-5 mb-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="dashboard-user-avatar" style="width: 78px; height: 78px; font-size: 1.2rem;">
                            @if ($profileImage)
                                <img src="{{ $profileImage }}" alt="{{ $displayName }}" class="img-fluid rounded-circle w-100 h-100 object-fit-cover">
                            @else
                                <span>{{ $initials ?: 'U' }}</span>
                            @endif
                        </div>
                        <div>
                            <div class="small text-uppercase text-secondary-custom fw-bold">Profile overview</div>
                            <h3 class="fw-bold mb-1">{{ $displayName }}</h3>
                            <div class="text-secondary-custom">{{ $profileHeadline }}</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="text-center px-3 py-2 rounded-4" style="background: rgba(124,77,255,0.06); border: 1px solid rgba(124,77,255,0.12); min-width: 120px;">
                            <div class="small text-secondary-custom">Profile score</div>
                            <div class="fw-bold" style="font-size: 1.4rem; color: var(--primary-strong);">{{ $profileScore }}%</div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary-custom text-white">Edit profile</a>
                    </div>
                </div>
            </div>

            <div class="card-soft p-4 p-lg-5">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>
@endsection
