@extends('layouts.public')

@section('title', 'How It Works | CareerPilot AI')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title">How CareerPilot AI works</h1>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-soft p-4 h-100">
                    <div class="fw-bold text-primary-custom mb-2">Step 1</div>
                    <h5 class="fw-bold">Build your profile</h5>
                    <p class="text-secondary-custom mb-0">Add your background, skills, and resume library to create a professional foundation.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-soft p-4 h-100">
                    <div class="fw-bold text-primary-custom mb-2">Step 2</div>
                    <h5 class="fw-bold">Receive AI analysis</h5>
                    <p class="text-secondary-custom mb-0">Match your resume against target roles and get gaps, suggestions, and ATS guidance.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-soft p-4 h-100">
                    <div class="fw-bold text-primary-custom mb-2">Step 3</div>
                    <h5 class="fw-bold">Apply with confidence</h5>
                    <p class="text-secondary-custom mb-0">Track every application and practice interviews until you’re ready for the next opportunity.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
