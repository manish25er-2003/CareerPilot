@extends('layouts.dashboard')

@section('title', 'Reports | CareerPilot AI')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="small text-secondary-custom">Applications</div>
            <div class="display-6 fw-bold mt-2">{{ $totals['applications'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="small text-secondary-custom">Interviews</div>
            <div class="display-6 fw-bold mt-2">{{ $totals['interviews'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="small text-secondary-custom">Resumes</div>
            <div class="display-6 fw-bold mt-2">{{ $totals['resumes'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="summary-card h-100">
            <div class="small text-secondary-custom">AI analyses</div>
            <div class="display-6 fw-bold mt-2">{{ $totals['analyses'] }}</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card-soft p-4 h-100">
            <h5 class="fw-bold mb-3">Application status breakdown</h5>
            @foreach($statusBreakdown as $status => $count)
            <div class="mb-3">
                <div class="d-flex justify-content-between small text-secondary-custom mb-1">
                    <span>{{ $status }}</span>
                    <span>{{ $count }}</span>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-primary-custom" style="width: {{ min(100, (($count / max(1, $statusBreakdown->sum())) * 100)) }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-soft p-4 h-100">
            <h5 class="fw-bold mb-3">Interview readiness</h5>
            <div class="display-5 fw-bold text-primary-custom">{{ $averageScore }}%</div>
            <p class="text-secondary-custom mt-3 mb-0">Your average interview score across all completed sessions.</p>
        </div>
    </div>
</div>
@endsection