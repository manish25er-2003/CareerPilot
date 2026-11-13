@extends('layouts.dashboard')

@section('title', 'Admin Dashboard | CareerPilot AI')

@section('content')
<div class="row g-4 mb-4">
    @php
    $adminCards = [
    ['label' => 'Total users', 'value' => $stats['users'] ?? 0],
    ['label' => 'Active users', 'value' => $stats['active_users'] ?? 0],
    ['label' => 'Total resumes', 'value' => $stats['resumes'] ?? 0],
    ['label' => 'Total applications', 'value' => $stats['applications'] ?? 0],
    ['label' => 'AI analyses', 'value' => $stats['analyses'] ?? 0],
    ['label' => 'Completed interviews', 'value' => $stats['completed_interviews'] ?? 0],
    ];
    @endphp

    @foreach($adminCards as $card)
    <div class="col-md-6 col-xl-4">
        <div class="summary-card h-100">
            <div class="small text-secondary-custom">{{ $card['label'] }}</div>
            <div class="display-6 fw-bold mt-2">{{ $card['value'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-4">
    <div class="col-xl-7">
        <div class="card-soft p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Recent users</h5>
                <span class="badge bg-soft-blue text-primary-custom">{{ $recentUsers->count() }} users</span>
            </div>

            @forelse($recentUsers as $user)
            <div class="analysis-item">
                <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                    <div>
                        <div class="fw-semibold">{{ $user->name }}</div>
                        <div class="small text-secondary-custom">{{ $user->email }}</div>
                    </div>
                    <span class="badge {{ $user->is_active ? 'bg-success-subtle text-success' : 'bg-light text-dark border' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            @empty
            <div class="text-center text-secondary-custom py-4">No recent users yet.</div>
            @endforelse
        </div>
    </div>

    <div class="col-xl-5">
        <div class="card-soft p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Recent support messages</h5>
                <span class="badge bg-soft-blue text-primary-custom">{{ $contacts->count() }} active</span>
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
    </div>
</div>

<div class="card-soft p-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Recent activity</h5>
        <span class="badge bg-soft-blue text-primary-custom">{{ $recentActivities->count() }} logs</span>
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
@endsection