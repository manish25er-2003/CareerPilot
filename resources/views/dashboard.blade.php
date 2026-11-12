@extends('layouts.dashboard')

@section('title', 'Dashboard | CareerPilot AI')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="text-secondary-custom small">Profile completion</div>
            <div class="display-6 fw-bold mt-2">{{ $profile?->profile_score ?? 0 }}%</div>
            <div class="text-secondary-custom small mt-2">Keep building your profile to unlock stronger job matches.</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="text-secondary-custom small">Uploaded resumes</div>
            <div class="display-6 fw-bold mt-2">{{ $resumesCount }}</div>
            <div class="text-secondary-custom small mt-2">Use a tailored resume for each role.</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="text-secondary-custom small">Job applications</div>
            <div class="display-6 fw-bold mt-2">{{ $applicationsCount }}</div>
            <div class="text-secondary-custom small mt-2">Applications tracked across your pipeline.</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="text-secondary-custom small">Average interview score</div>
            <div class="display-6 fw-bold mt-2">{{ $averageInterviewScore }}%</div>
            <div class="text-secondary-custom small mt-2">Your confidence is steadily improving.</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-7">
        <div class="card-soft p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Recent job applications</h5>
                <a href="{{ route('jobs.index') }}" class="btn btn-sm btn-outline-custom">View all</a>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr class="text-secondary-custom small">
                            <th>Company</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Applied</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentApplications as $job)
                            <tr>
                                <td class="fw-semibold">{{ $job->company_name }}</td>
                                <td>{{ $job->job_title }}</td>
                                <td><span class="badge bg-soft-blue text-primary-custom">{{ $job->status }}</span></td>
                                <td>{{ $job->applied_at ? \Carbon\Carbon::parse($job->applied_at)->format('M d, Y') : '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-secondary-custom text-center py-4">No job applications yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="card-soft p-4 h-100">
            <h5 class="fw-bold mb-3">Upcoming interview reminders</h5>
            @forelse($upcomingInterviews as $interview)
                <div class="dashboard-mini-card mb-3">
                    <div class="fw-semibold">{{ $interview->company_name }}</div>
                    <div class="small text-secondary-custom">{{ $interview->job_title }}</div>
                    <div class="small text-primary-custom mt-2">{{ $interview->interview_date ? \Carbon\Carbon::parse($interview->interview_date)->format('M d, Y h:i A') : 'No date set' }}</div>
                </div>
            @empty
                <p class="text-secondary-custom mb-0">No upcoming interviews scheduled.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card-soft p-4">
            <h5 class="fw-bold mb-3">Recent AI analysis</h5>
            @forelse($recentAnalyses as $analysis)
                <div class="analysis-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold">{{ $analysis->job_title }}</div>
                        <div class="small text-secondary-custom">{{ $analysis->created_at->diffForHumans() }}</div>
                    </div>
                    <span class="badge bg-success-subtle text-success">{{ $analysis->overall_score }}%</span>
                </div>
            @empty
                <p class="text-secondary-custom mb-0">No AI resume analyses yet.</p>
            @endforelse
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card-soft p-4">
            <h5 class="fw-bold mb-3">Career progress</h5>
            <div class="d-grid gap-2">
                @foreach($statusCounts as $status => $count)
                    <div class="progress-row">
                        <div class="d-flex justify-content-between small text-secondary-custom mb-1">
                            <span>{{ $status }}</span>
                            <span>{{ $count }}</span>
                        </div>
                        <div class="progress" style="height: 8px; background: rgba(124,77,255,0.08);">
                            <div class="progress-bar bg-primary-custom" role="progressbar" style="width: {{ $count ? min(100, ($count / max(1, array_sum($statusCounts))) * 100) : 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
