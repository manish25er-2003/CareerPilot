@extends('layouts.dashboard')

@section('title', 'AI Resume Analysis | CareerPilot AI')

@section('content')
<div class="card-soft p-4 mb-4">
    <h4 class="fw-bold mb-2">Resume intelligence and role recommendations</h4>
    <p class="text-secondary-custom mb-3">Analyze a resume for extracted experience, suitable career profiles, skill gaps, and a personalized roadmap. Add a target role for a focused match.</p>
    <form method="POST" action="{{ route('ai-analysis.store') }}" class="row g-3">
        @csrf
        <div class="col-md-4">
            <label class="form-label" for="resume_id">Resume</label>
            <select id="resume_id" name="resume_id" class="form-select" required>
                <option value="">Select a resume</option>
                @foreach($resumes as $resume)
                <option value="{{ $resume->id }}" @selected(old('resume_id') == $resume->id)>{{ $resume->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="job_title">Target job title <span class="text-secondary-custom">(optional)</span></label>
            <input id="job_title" type="text" name="job_title" value="{{ old('job_title') }}" class="form-control" placeholder="Senior Product Analyst">
        </div>
        <div class="col-md-12">
            <label class="form-label" for="job_description">Target job description <span class="text-secondary-custom">(optional)</span></label>
            <textarea id="job_description" name="job_description" rows="5" class="form-control" placeholder="Paste the role description for a focused skills comparison...">{{ old('job_description') }}</textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary-custom text-white" @disabled($resumes->isEmpty())>Analyze resume</button>
            @if($resumes->isEmpty())
            <a href="{{ route('resumes.index') }}" class="btn btn-outline-custom ms-2">Upload a resume</a>
            @endif
        </div>
    </form>
</div>

<div class="row g-4">
    @forelse($analyses as $analysis)
    <div class="col-lg-6">
        <div class="card-soft p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1">{{ $analysis->job_title ?: 'Resume-based recommendations' }}</h5>
                    <div class="small text-secondary-custom">{{ $analysis->created_at->format('M d, Y') }} · {{ $analysis->analysis_source === 'gemini' ? 'Gemini AI' : 'Local resume-based analysis' }}</div>
                </div>
                <span class="badge bg-success-subtle text-success fw-semibold">{{ $analysis->overall_score }}%</span>
            </div>
            @if($analysis->analysis_source !== 'gemini')
            <div class="alert alert-info py-2 small">Gemini is not configured or unavailable. These results use local resume-based matching and may be less detailed.</div>
            @endif
            <div class="mb-3">
                <div class="small text-secondary-custom">{{ $analysis->job_description ? 'Target job match' : 'Top role match' }}</div>
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
                <h6 class="fw-bold">Matched skills</h6>
                <div class="d-flex flex-wrap gap-2">
                    @forelse($analysis->matched_skills ?? [] as $skill)
                    <span class="badge bg-success-subtle text-success">{{ $skill }}</span>
                    @empty
                    <span class="small text-secondary-custom">No explicit skill matches found{{ $analysis->job_description ? ' for this target.' : '.' }}</span>
                    @endforelse
                </div>
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
            <div class="mb-3">
                <h6 class="fw-bold">Recommended job profiles</h6>
                @forelse($analysis->role_recommendations ?? [] as $role)
                <div class="border rounded-3 p-3 mb-2">
                    <div class="d-flex justify-content-between gap-2">
                        <strong>{{ $role['role_title'] }}</strong>
                        <span class="badge bg-soft-blue text-primary-custom">{{ $role['match_percentage'] }}%</span>
                    </div>
                    <p class="small text-secondary-custom my-2">{{ $role['explanation'] }}</p>
                    @if(!empty($role['matched_skills']))
                    <div class="small"><strong>Matches:</strong> {{ implode(', ', $role['matched_skills']) }}</div>
                    @endif
                    @if(!empty($role['missing_skills']))
                    <div class="small"><strong>To develop:</strong> {{ implode(', ', $role['missing_skills']) }}</div>
                    @endif
                    <a href="{{ route('jobs.index', ['job_title' => $role['role_title']]) }}" class="btn btn-sm btn-outline-custom mt-2">Track this role</a>
                </div>
                @empty
                <p class="small text-secondary-custom mb-0">No role profiles were returned for this analysis.</p>
                @endforelse
            </div>
            @if($analysis->structured_profile)
            <div class="mb-3">
                <h6 class="fw-bold">Extracted from resume</h6>
                @foreach(['education' => 'Education', 'skills' => 'Skills', 'experience' => 'Experience', 'projects' => 'Projects'] as $key => $label)
                <div class="small mb-2">
                    <strong>{{ $label }}:</strong>
                    {{ !empty($analysis->structured_profile[$key]) ? implode(' · ', $analysis->structured_profile[$key]) : 'No details identified' }}
                </div>
                @endforeach
            </div>
            @endif
            @if(!empty($analysis->skill_gaps))
            <div class="mb-3">
                <h6 class="fw-bold">Skill gaps and learning recommendations</h6>
                @foreach($analysis->skill_gaps as $gap)
                <div class="small border-start border-3 ps-2 mb-2">
                    <strong>{{ $gap['skill'] }}</strong> · {{ ucfirst($gap['priority']) }} priority
                    <div class="text-secondary-custom">{{ $gap['reason'] }}</div>
                    <div>{{ $gap['learning_recommendation'] }}</div>
                </div>
                @endforeach
            </div>
            @endif
            @if(!empty($analysis->career_roadmap))
            <div class="mb-3">
                <h6 class="fw-bold">Career roadmap</h6>
                @foreach($analysis->career_roadmap as $phase)
                <div class="small mb-2">
                    <strong>{{ $phase['timeframe'] }} · {{ $phase['focus'] }}</strong>
                    <ul class="mb-0">
                        @foreach($phase['actions'] as $action)
                        <li>{{ $action }}</li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            @endif
            @if(!empty($analysis->learning_recommendations))
            <div class="mb-3">
                <h6 class="fw-bold">Learning recommendations</h6>
                <ul class="mb-0 text-secondary-custom">
                    @foreach($analysis->learning_recommendations as $recommendation)
                    <li><strong>{{ $recommendation['skill'] }}:</strong> {{ $recommendation['recommendation'] }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
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