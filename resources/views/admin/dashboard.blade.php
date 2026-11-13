@extends('layouts.dashboard')

@section('title', 'Admin Dashboard | CareerPilot AI')

@section('content')
@php
$adminCards = [
['label' => 'Total users', 'value' => $stats['users'] ?? 0, 'meta' => 'Platform members', 'tone' => 'purple'],
['label' => 'Active users', 'value' => $stats['active_users'] ?? 0, 'meta' => 'Currently active', 'tone' => 'blue'],
['label' => 'Total resumes', 'value' => $stats['resumes'] ?? 0, 'meta' => 'Uploaded profiles', 'tone' => 'green'],
['label' => 'Total applications', 'value' => $stats['applications'] ?? 0, 'meta' => 'Submitted jobs', 'tone' => 'orange'],
['label' => 'AI analyses', 'value' => $stats['analyses'] ?? 0, 'meta' => 'Resume evaluations', 'tone' => 'purple'],
['label' => 'Completed interviews', 'value' => $stats['completed_interviews'] ?? 0, 'meta' => 'Interview sessions', 'tone' => 'green'],
];
@endphp

<div class="jobflow-dashboard-page">
    <div class="jobflow-hero-banner jobflow-hero-banner--admin">
        <div class="jobflow-hero-copy">
            <span class="jobflow-hero-pill">Platform overview</span>
            <h2>Welcome back, admin!</h2>
            <p>Track usage, engagement, and key growth metrics across the CareerPilot AI platform.</p>
            <a href="{{ route('home') }}" class="jobflow-cta-button">View Insights →</a>
        </div>
        <div class="jobflow-hero-visual" aria-hidden="true">
            <div class="jobflow-hero-device">
                <div class="jobflow-hero-screen"></div>
            </div>
            <div class="jobflow-mini-card jobflow-mini-card--chart">📊</div>
            <div class="jobflow-mini-card jobflow-mini-card--briefcase">👥</div>
            <div class="jobflow-mini-card jobflow-mini-card--note">📈</div>
        </div>
    </div>

    <div class="jobflow-upper-grid">
        <div class="jobflow-stat-grid">
            @foreach($adminCards as $card)
            <div class="jobflow-stat-card {{ $loop->first ? 'is-primary' : '' }}">
                <div class="jobflow-stat-header">
                    <span>{{ $card['label'] }}</span>
                    <span class="jobflow-arrow">→</span>
                </div>
                <div class="jobflow-stat-value">{{ $card['value'] }}</div>
                <div class="jobflow-stat-meta">{{ $card['meta'] }}</div>
            </div>
            @endforeach
        </div>

        <div class="jobflow-schedule-card">
            <div class="jobflow-card-header">
                <h3>Recent users</h3>
                <button type="button" class="jobflow-mini-icon">◍</button>
            </div>

            @forelse($recentUsers as $user)
            <div class="jobflow-schedule-item">
                <div class="jobflow-date-box" style="background: rgba(139, 92, 246, 0.10); color: #5b47e7;">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <div class="jobflow-schedule-text">
                    <div class="jobflow-schedule-name">{{ $user->name }}</div>
                    <div class="jobflow-schedule-meta">{{ $user->email }}</div>
                    <div class="jobflow-schedule-meta">{{ $user->is_active ? 'Active' : 'Inactive' }}</div>
                </div>
                <button type="button" class="jobflow-next-icon">→</button>
            </div>
            @empty
            <div class="text-center text-secondary-custom py-4">No recent users yet.</div>
            @endforelse
        </div>
    </div>

    <div class="jobflow-lower-grid">
        <div class="jobflow-table-card">
            <div class="jobflow-card-header jobflow-table-header">
                <h3>Recent support messages</h3>
                <div class="jobflow-table-tools">
                    <span>⌕</span>
                    <span>◌</span>
                </div>
            </div>

            @forelse($contacts as $contact)
            <div class="analysis-item">
                <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                    <div>
                        <div class="fw-semibold">{{ $contact->name }}</div>
                        <div class="small text-secondary-custom">{{ $contact->email }}</div>
                    </div>
                    <span class="badge bg-light text-dark border">{{ $contact->subject ?? 'General enquiry' }}</span>
                </div>
                <p class="mb-0 mt-3 text-secondary-custom">{{ \Illuminate\Support\Str::limit($contact->message, 120) }}</p>
            </div>
            @empty
            <div class="text-center text-secondary-custom py-4">No contact messages yet.</div>
            @endforelse
        </div>

        <div class="jobflow-recommendation-panel">
            <div class="jobflow-card-header jobflow-recommend-header">
                <h3>Recent activity</h3>
                <button type="button" class="jobflow-link-button subtle">View all</button>
            </div>

            @forelse($recentActivities as $activity)
            <div class="analysis-item">
                <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                    <div>
                        <div class="fw-semibold">{{ $activity->user?->name ?? 'System' }}</div>
                        <div class="small text-secondary-custom">{{ $activity->action }}</div>
                    </div>
                    <span class="small text-secondary-custom">{{ $activity->created_at?->diffForHumans() ?? 'recently' }}</span>
                </div>
                <p class="mb-0 mt-3 text-secondary-custom">{{ $activity->description }}</p>
            </div>
            @empty
            <div class="text-center text-secondary-custom py-4">No recent activity yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection