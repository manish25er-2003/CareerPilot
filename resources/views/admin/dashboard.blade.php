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
    <h5 class="fw-bold mb-3">Recent support messages</h5>
    <div class="table-responsive">
        <table class="table table-borderless align-middle">
            <thead>
                <tr class="text-secondary-custom small">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject ?? 'General enquiry' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($contact->message, 80) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-secondary-custom py-4">No contact messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
