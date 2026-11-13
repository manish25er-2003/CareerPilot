@extends('layouts.public')

@section('title', 'Features | CareerPilot AI')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title">Powerful features for modern career growth</h1>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card-soft p-4 h-100">
                    <div class="feature-icon">AI</div>
                    <h5 class="fw-bold">AI Resume Analysis</h5>
                    <p class="text-secondary-custom mb-0">Detect ATS gaps, missing technical skills, and better keyword alignment with your target role.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card-soft p-4 h-100">
                    <div class="feature-icon">DB</div>
                    <h5 class="fw-bold">Career Dashboard</h5>
                    <p class="text-secondary-custom mb-0">Track applications, profiles, interviews, and outcomes in a single performance dashboard.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card-soft p-4 h-100">
                    <div class="feature-icon">SK</div>
                    <h5 class="fw-bold">Skills Management</h5>
                    <p class="text-secondary-custom mb-0">Organize skills by category, track proficiency, and highlight strengths relevant to open jobs.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card-soft p-4 h-100">
                    <div class="feature-icon">RS</div>
                    <h5 class="fw-bold">Resume Library</h5>
                    <p class="text-secondary-custom mb-0">Store multiple resume versions, mark primary documents, and keep a clear application history.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card-soft p-4 h-100">
                    <div class="feature-icon">MI</div>
                    <h5 class="fw-bold">Mock Interviews</h5>
                    <p class="text-secondary-custom mb-0">Practice with role-specific, AI-generated questions and structured evaluation feedback.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card-soft p-4 h-100">
                    <div class="feature-icon">AL</div>
                    <h5 class="fw-bold">Smart Alerts</h5>
                    <p class="text-secondary-custom mb-0">Stay on top of reminders, interview dates, profile tasks, and job application updates.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection