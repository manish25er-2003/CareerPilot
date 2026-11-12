@extends('layouts.dashboard')

@section('title', 'Admin Dashboard | CareerPilot AI')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="small text-secondary-custom">Users</div>
            <div class="display-6 fw-bold mt-2">{{ $stats['users'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="small text-secondary-custom">Active users</div>
            <div class="display-6 fw-bold mt-2">{{ $stats['active_users'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="small text-secondary-custom">Resumes</div>
            <div class="display-6 fw-bold mt-2">{{ $stats['resumes'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="small text-secondary-custom">AI analyses</div>
            <div class="display-6 fw-bold mt-2">{{ $stats['analyses'] }}</div>
        </div>
    </div>
</div>

<div class="card-soft p-4">
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
@endsection
