@extends('layouts.dashboard')

@section('title', 'Job Applications | CareerPilot AI')

@section('content')
<div class="card-soft p-4 mb-4">
    <h4 class="fw-bold mb-3">Track opportunities</h4>
    <form method="POST" action="{{ route('jobs.store') }}" class="row g-3">
        @csrf
        <div class="col-md-4">
            <label class="form-label">Company</label>
            <input type="text" name="company_name" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Job title</label>
            <input type="text" name="job_title" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option>Saved</option>
                <option selected>Applied</option>
                <option>Shortlisted</option>
                <option>Interviewing</option>
                <option>Offered</option>
                <option>Rejected</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">Job type</label>
            <input type="text" name="job_type" class="form-control" placeholder="Full-time">
        </div>
        <div class="col-md-4">
            <label class="form-label">Applied date</label>
            <input type="date" name="applied_at" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Job URL</label>
            <input type="url" name="job_url" class="form-control" placeholder="https://">
        </div>
        <div class="col-md-6">
            <label class="form-label">Salary range</label>
            <input type="text" name="salary_range" class="form-control" placeholder="$120k - $150k">
        </div>
        <div class="col-12">
            <label class="form-label">Notes</label>
            <textarea name="notes" rows="3" class="form-control"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary-custom text-white">Save application</button>
        </div>
    </form>
</div>

<div class="card-soft p-4">
    <h5 class="fw-bold mb-3">Recent tracking</h5>
    <div class="table-responsive">
        <table class="table table-borderless align-middle">
            <thead>
                <tr class="text-secondary-custom small">
                    <th>Company</th>
                    <th>Role</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Applied</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                    <tr>
                        <td class="fw-semibold">{{ $job->company_name }}</td>
                        <td>{{ $job->job_title }}</td>
                        <td>{{ $job->location ?? '—' }}</td>
                        <td><span class="badge bg-soft-blue text-primary-custom">{{ $job->status }}</span></td>
                        <td>{{ $job->applied_at ? \Carbon\Carbon::parse($job->applied_at)->format('M d, Y') : '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-secondary-custom py-4">No applications yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
