@extends('layouts.public')

@section('title', 'Meet the Developer | CareerPilot AI')

@section('content')
<section class="developer-page">
    <div class="container developer-container">
        <article class="developer-card">
            <div class="developer-code-decoration" aria-hidden="true">&lt;/&gt;</div>

            <div class="developer-hero-grid">
                <div class="developer-avatar-column">
                    <div class="developer-avatar">
                        <img src="{{ asset('Portrait in a Lush Garden Setting (1).png') }}" alt="{{ $developer['name'] }} portrait">
                        <span class="developer-online-dot" aria-label="Available"></span>
                    </div>
                </div>

                <div class="developer-content">
                    <div class="developer-label">
                        <span class="developer-label-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="m8 7-5 5 5 5M16 7l5 5-5 5M14 4l-4 16" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        Developer Profile
                    </div>

                    <h1 class="developer-name">{{ $developer['name'] }}</h1>
                    <p class="developer-role">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 6V4.8A1.8 1.8 0 0 1 10.8 3h2.4A1.8 1.8 0 0 1 15 4.8V6m-13 3h20v9a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9Zm0 0a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2m-13 0v2h4V9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        {{ $developer['role'] }}
                    </p>

                    <div class="developer-divider"></div>
                    <p class="developer-intro">{{ $developer['intro'] }}</p>

                    <div class="developer-actions">
                        <a href="{{ $developer['portfolioUrl'] }}" target="_blank" rel="noopener noreferrer" class="developer-button developer-button-primary">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.8" />
                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                            </svg>
                            View My Portfolio
                            <span aria-hidden="true">→</span>
                        </a>
                        <a href="{{ route('home') }}" class="developer-button developer-button-secondary">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="m3 11 9-8 9 8v9a1 1 0 0 1-1 1h-5v-6h-6v6H4a1 1 0 0 1-1-1v-9Z" fill="currentColor" />
                            </svg>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>

            <div class="developer-highlights">
                <div class="developer-highlight">
                    <span class="highlight-icon highlight-icon-project" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M3 7.5A1.5 1.5 0 0 1 4.5 6H10l2 2h7.5A1.5 1.5 0 0 1 21 9.5v9a1.5 1.5 0 0 1-1.5 1.5h-15A1.5 1.5 0 0 1 3 18.5v-11Z" fill="currentColor" />
                            <path d="M3 10h18" stroke="#fff" stroke-opacity=".55" stroke-width="1.2" />
                        </svg>
                    </span>
                    <span class="highlight-copy">
                        <small>Featured Project</small>
                        <strong>{{ $developer['featuredProject'] }}</strong>
                    </span>
                </div>
                <div class="developer-highlight">
                    <span class="highlight-icon highlight-icon-portfolio" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
                            <path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18" stroke="currentColor" stroke-width="1.6" />
                        </svg>
                    </span>
                    <span class="highlight-copy">
                        <small>Portfolio</small>
                        <a href="{{ $developer['portfolioUrl'] }}" target="_blank" rel="noopener noreferrer">
                            manishpro.in <span aria-hidden="true">↗</span>
                        </a>
                    </span>
                </div>
                <div class="developer-highlight">
                    <span class="highlight-icon highlight-icon-experience" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="m12 2.8 2.8 5.7 6.3.9-4.6 4.5 1.1 6.3-5.6-3-5.6 3 1.1-6.3-4.6-4.5 6.3-.9L12 2.8Z" />
                        </svg>
                    </span>
                    <span class="highlight-copy">
                        <small>Experience</small>
                        <strong>{{ $developer['experience'] }}</strong>
                    </span>
                </div>
            </div>
        </article>

        <div class="developer-detail-grid">
            <section class="detail-panel" aria-labelledby="developer-skills-title">
                <div class="detail-panel-heading">
                    <div class="detail-panel-title">
                        <span class="detail-heading-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="m13.2 2-9 11.2a.8.8 0 0 0 .6 1.3h5l-.8 7.5 10.8-12.5a.8.8 0 0 0-.6-1.3h-5.3L15 2.8a.9.9 0 0 0-1.8-.8Z" />
                            </svg>
                        </span>
                        <h2 id="developer-skills-title">Skills</h2>
                    </div>
                    <a href="{{ $developer['portfolioUrl'] }}" target="_blank" rel="noopener noreferrer" class="view-all-link">
                        View All <span aria-hidden="true">→</span>
                    </a>
                </div>

                <div class="skill-list">
                    @foreach($developer['skills'] as $skill)
                    <span class="skill-pill">
                        <span class="skill-mark skill-mark-{{ $skill['icon'] }}" aria-hidden="true">
                            @switch($skill['icon'])
                            @case('mysql')
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2 3 6v2l9 4 9-4V6l-9-4Zm-9 9v3l9 4 9-4v-3l-9 4-9-4Zm0 7v2l9 4 9-4v-2l-9 4-9-4Z" />
                            </svg>
                            @break
                            @case('php')
                            php
                            @break
                            @case('javascript')
                            JS
                            @break
                            @case('html')
                            5
                            @break
                            @case('css')
                            3
                            @break
                            @case('bootstrap')
                            B
                            @break
                            @case('github')
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 .9a11.1 11.1 0 0 0-3.5 21.6c.6.1.8-.2.8-.6v-2.1c-3.1.7-3.8-1.3-3.8-1.3-.5-1.2-1.2-1.5-1.2-1.5-1-.7.1-.7.1-.7 1.1.1 1.7 1.1 1.7 1.1 1 .1.5 2.1 3.2 1.5.1-.7.4-1.2.7-1.5-2.5-.3-5.1-1.3-5.1-5.5 0-1.2.4-2.2 1.1-3-.1-.3-.5-1.4.1-2.9 0 0 .9-.3 3.1 1.1a10.7 10.7 0 0 1 5.6 0c2.1-1.4 3.1-1.1 3.1-1.1.6 1.5.2 2.6.1 2.9.7.8 1.1 1.8 1.1 3 0 4.2-2.6 5.1-5.1 5.4.4.3.8 1 .8 2v3.1c0 .4.2.7.8.6A11.1 11.1 0 0 0 12 .9Z" />
                            </svg>
                            @break
                            @default
                            {{ strtoupper(substr($skill['name'], 0, 1)) }}
                            @endswitch
                        </span>
                        {{ $skill['name'] }}
                    </span>
                    @endforeach
                </div>
            </section>

            <section class="detail-panel professional-panel" aria-labelledby="professional-details-title">
                <div class="detail-panel-heading">
                    <div class="detail-panel-title">
                        <span class="detail-heading-icon detail-heading-icon-profile" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm-9 9a9 9 0 0 1 18 0H3Z" />
                            </svg>
                        </span>
                        <h2 id="professional-details-title">Professional Details</h2>
                    </div>
                </div>

                <dl class="professional-details">
                    <div class="professional-detail-row">
                        <dt>
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M9 6V4.8A1.8 1.8 0 0 1 10.8 3h2.4A1.8 1.8 0 0 1 15 4.8V6h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3Zm2 0h2V5h-2v1Zm-7 5h16v3h-6v2h-4v-2H4v-3Z" />
                            </svg>
                            <span>Role:</span>
                        </dt>
                        <dd>{{ $developer['role'] }}</dd>
                    </div>
                    <div class="professional-detail-row">
                        <dt>
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle cx="10.5" cy="10.5" r="7" stroke="currentColor" stroke-width="2" />
                                <circle cx="10.5" cy="10.5" r="2.5" stroke="currentColor" stroke-width="2" />
                                <path d="m16 16 5 5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                            </svg>
                            <span>Focus:</span>
                        </dt>
                        <dd>{{ $developer['focus'] }}</dd>
                    </div>
                    <div class="professional-detail-row">
                        <dt>
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M10 13.5a4 4 0 0 0 5.7 0l3.5-3.5a4 4 0 0 0-5.7-5.7l-2 2m2.5 4.2a4 4 0 0 0-5.7 0l-3.5 3.5a4 4 0 0 0 5.7 5.7l2-2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <span>Portfolio:</span>
                        </dt>
                        <dd>
                            <a href="{{ $developer['portfolioUrl'] }}" target="_blank" rel="noopener noreferrer">
                                {{ $developer['portfolioUrl'] }} <span aria-hidden="true">↗</span>
                            </a>
                        </dd>
                    </div>
                    @if(! empty($developer['email']))
                    <div class="professional-detail-row">
                        <dt><span>Email:</span></dt>
                        <dd><a href="mailto:{{ $developer['email'] }}">{{ $developer['email'] }}</a></dd>
                    </div>
                    @endif
                    @if(! empty($developer['githubUrl']))
                    <div class="professional-detail-row">
                        <dt><span>GitHub:</span></dt>
                        <dd><a href="{{ $developer['githubUrl'] }}" target="_blank" rel="noopener noreferrer">{{ $developer['githubUrl'] }}</a></dd>
                    </div>
                    @endif
                    @if(! empty($developer['linkedinUrl']))
                    <div class="professional-detail-row">
                        <dt><span>LinkedIn:</span></dt>
                        <dd><a href="{{ $developer['linkedinUrl'] }}" target="_blank" rel="noopener noreferrer">{{ $developer['linkedinUrl'] }}</a></dd>
                    </div>
                    @endif
                </dl>
            </section>
        </div>
    </div>
</section>
@endsection
