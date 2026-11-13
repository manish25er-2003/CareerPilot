@extends('layouts.public')

@section('title', 'Meet the Developer | CareerPilot AI')

@section('content')
<section class="developer-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="developer-card">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-4 text-center">
                            <div class="developer-avatar mx-auto">
                                MY
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="developer-label">Developer Profile</div>
                            <h1 class="developer-name">{{ $developer['name'] }}</h1>
                            <div class="developer-role">{{ $developer['role'] }}</div>
                            <p class="developer-intro">{{ $developer['intro'] }}</p>

                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <a href="{{ $developer['portfolioUrl'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary-custom text-white">
                                    View My Portfolio
                                </a>
                                <a href="{{ route('home') }}" class="btn btn-outline-custom">Back to Home</a>
                            </div>

                            <div class="developer-meta-grid row g-3">
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <span class="info-label">Featured Project</span>
                                        <strong>{{ $developer['featuredProject'] }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <span class="info-label">Portfolio</span>
                                        <a href="{{ $developer['portfolioUrl'] }}" target="_blank" rel="noopener noreferrer" class="info-link">manishpro.in</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="developer-detail-grid mt-4">
                    <div class="detail-panel">
                        <h3>Skills</h3>
                        <div class="skill-list">
                            @foreach($developer['skills'] as $skill)
                                <span class="skill-pill">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="detail-panel">
                        <h3>Professional Details</h3>
                        <ul class="profile-list">
                            <li><strong>Role:</strong> {{ $developer['role'] }}</li>
                            <li><strong>Focus:</strong> Product-focused web experiences and scalable Laravel applications</li>
                            <li><strong>Portfolio:</strong> <a href="{{ $developer['portfolioUrl'] }}" target="_blank" rel="noopener noreferrer">{{ $developer['portfolioUrl'] }}</a></li>
                            @if(! empty($developer['email']))
                                <li><strong>Email:</strong> <a href="mailto:{{ $developer['email'] }}">{{ $developer['email'] }}</a></li>
                            @endif
                            @if(! empty($developer['githubUrl']))
                                <li><strong>GitHub:</strong> <a href="{{ $developer['githubUrl'] }}" target="_blank" rel="noopener noreferrer">{{ $developer['githubUrl'] }}</a></li>
                            @endif
                            @if(! empty($developer['linkedinUrl']))
                                <li><strong>LinkedIn:</strong> <a href="{{ $developer['linkedinUrl'] }}" target="_blank" rel="noopener noreferrer">{{ $developer['linkedinUrl'] }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
