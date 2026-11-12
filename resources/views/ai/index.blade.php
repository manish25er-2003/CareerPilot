@extends('layouts.dashboard')

@section('title', 'AI Resume Analysis | CareerPilot AI')

@section('content')
<div class="card-soft p-4 mb-4">
    <h4 class="fw-bold mb-3">AI resume match check</h4>
    <form method="POST" action="{{ route('ai-analysis.store') }}" class="row g-3">
        @csrf
        <div class="col-md-4">
            <label class="form-label">Resume</label>
            <select name="resume_id" class="form-select" required>
                <option value="">Select a resume</option>
                @foreach($resumes as $resume)
                    <option value="{{ $resume->id }}">{{ $resume->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Job title</label>
            <input type="text" name="job_title" class="form-control" placeholder="Senior Product Analyst" required>
        </div>
        <div class="col-md-12">
            <label class="form-label">Job description</label>
            <textarea name="job_description" rows="6" class="form-control" placeholder="Paste the target role description here..." required></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary-custom text-white">Run analysis</button>
        </div>
    </form>
</div>

<div class="row g-4">
    @forelse($analyses as $analysis)
        <div class="col-lg-6">
            <div class="card-soft p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $analysis->job_title }}</h5>
                        <div class="small text-secondary-custom">{{ $analysis->created_at->format('M d, Y') }}</div>
                    </div>
                    <span class="badge bg-success-subtle text-success fw-semibold">{{ $analysis->overall_score }}%</span>
                </div>
                <div class="mb-3">
                    <div class="small text-secondary-custom">Match percentage</div>
                    <div class="fw-bold display-6">{{ $analysis->match_percentage }}%</div>
                </div>
                <div class="mb-3">
                    <h6 class="fw-bold">Summary</h6>
                    <p class="text-secondary-custom mb-0">{{ $analysis->summary }}</p>
                </div>
                <div class="mb-3">
                    <h6 class="fw-bold">Strengths</h6>
                    <ul class="mb-0 text-secondary-custom">
                        @foreach($analysis->strengths ?? [] as $strength)
                            <li>{{ $strength }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-3">
                    <h6 class="fw-bold">Missing skills</h6>
                    <ul class="mb-0 text-secondary-custom">
                        @forelse($analysis->missing_skills ?? [] as $skill)
                            <li>{{ $skill }}</li>
                        @empty
                            <li>None identified.</li>
                        @endforelse
                    </ul>
                </div>
                <div>
                    <h6 class="fw-bold">ATS suggestions</h6>
                    <ul class="mb-0 text-secondary-custom">
                        @foreach($analysis->ats_suggestions ?? [] as $suggestion)
                            <li>{{ $suggestion }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card-soft p-5 text-center">
                <p class="text-secondary-custom mb-0">No AI analyses yet. Upload a resume and run your first match check.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
