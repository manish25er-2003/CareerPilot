@extends('layouts.public')

@section('title', 'CareerPilot AI | Your AI-Powered Career Growth Partner')

@section('content')
<section class="public-home-hero py-5 py-lg-6 bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 hero-copy-column">
                <span class="hero-badge"><span aria-hidden="true">⚡</span> Your Career. Our Guidance.</span>
                <h1 class="hero-title mt-3">Build a stronger<br>career with<br><span>Career Copilot</span></h1>
                <p class="lead text-secondary-custom mt-4 mb-4">Get personalized career guidance, track progress, and achieve your goals with ease.</p>
                <div class="d-flex flex-wrap gap-3 mb-4 hero-actions">
                    <a href="{{ route('register') }}" class="btn btn-primary-custom text-white px-4 py-3">Get Started <span aria-hidden="true">→</span></a>
                    <a href="{{ route('features') }}" class="btn btn-outline-custom px-4 py-3"><span class="hero-play" aria-hidden="true">▶</span> Watch Demo</a>
                </div>
            </div>

            <div class="col-lg-6 hero-preview-column">
                <div class="career-preview-wrap">
                    <span class="hero-float-icon hero-float-icon--rocket" aria-hidden="true">🚀</span>
                    <span class="hero-float-icon hero-float-icon--chart" aria-hidden="true">
                        <svg viewBox="0 0 32 32">
                            <rect x="4" y="18" width="5" height="9" rx="2" />
                            <rect x="13.5" y="12" width="5" height="15" rx="2" />
                            <rect x="23" y="7" width="5" height="20" rx="2" />
                            <path d="M5 13 12 9l6 2 9-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <div class="career-preview">
                        <div class="career-preview__topbar">
                            <div class="career-preview__brand"><span>G</span> Career Copilot</div>
                            <div class="career-preview__profile"><span>👨🏻</span><b>⌄</b></div>
                        </div>
                        <div class="career-preview__body">
                            <aside class="career-preview__sidebar" aria-label="Preview navigation">
                                <div class="career-preview__nav-item active"><span>⌂</span> Dashboard</div>
                                <div class="career-preview__nav-item"><span>▣</span> Career Plan</div>
                                <div class="career-preview__nav-item"><span>▦</span> Resources</div>
                                <div class="career-preview__nav-item"><span>▥</span> Analytics</div>
                                <div class="career-preview__nav-item"><span>⚙</span> Settings</div>
                            </aside>
                            <div class="career-preview__main">
                                <h2>Welcome back!</h2>
                                <p>Let’s continue your career journey</p>
                                <div class="career-score-card">
                                    <span>Your Career Score</span>
                                    <strong>92%</strong>
                                    <svg viewBox="0 0 300 80" role="img" aria-label="Career score chart">
                                        <defs>
                                            <linearGradient id="heroChartFill" x1="0" y1="0" x2="0" y2="1">
                                                <stop offset="0" stop-color="#ffffff" stop-opacity="0.28" />
                                                <stop offset="1" stop-color="#ffffff" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                        <path d="M0 66 C35 58 52 35 82 48 S125 64 152 42 S205 22 230 31 S270 10 300 0 L300 80 L0 80 Z" fill="url(#heroChartFill)" />
                                        <path d="M0 66 C35 58 52 35 82 48 S125 64 152 42 S205 22 230 31 S270 10 300 0" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" />
                                        <g fill="#fff">
                                            <circle cx="82" cy="48" r="4" />
                                            <circle cx="152" cy="42" r="4" />
                                            <circle cx="230" cy="31" r="4" />
                                            <circle cx="300" cy="0" r="4" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="hero-next-step"><span class="hero-next-step__icon">▦</span>
                                    <div><b>Next Step</b><small>Complete your skill assessment</small></div><span class="hero-next-step__arrow">›</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4 bg-white">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 gap-lg-5 text-secondary-custom small fw-semibold opacity-75">
            <span class="trusted-brand">Product</span>
            <span class="trusted-brand">Analytics</span>
            <span class="trusted-brand">Operations</span>
            <span class="trusted-brand">Marketing</span>
            <span class="trusted-brand">Design</span>
            <span class="trusted-brand">Growth</span>
        </div>
    </div>
</section>

<section class="job-search-features" aria-labelledby="job-search-features-title">
    <div class="container">
        <header class="job-search-features__heading">
            <span class="job-search-features__badge">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m12 3 8 4.5-8 4.5-8-4.5L12 3Z" fill="currentColor"/>
                    <path d="m4 12 8 4.5 8-4.5M4 16.5 12 21l8-4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Key Features
            </span>
            <h2 id="job-search-features-title">Fuel your next step in your <span>career</span></h2>
            <p>Three powerful tools to help you learn, grow, and get hired faster.</p>
        </header>

        <div class="row g-4 job-search-features__grid">
            <div class="col-12 col-md-6 col-lg-4">
                <article class="job-feature-card job-feature-card--learn">
                    <div class="job-feature-card__art">
                        <svg viewBox="0 0 180 130" fill="none" aria-hidden="true">
                            <defs>
                                <linearGradient id="learnBookGradient" x1="48" y1="65" x2="135" y2="112" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#BDA9FF"/>
                                    <stop offset="1" stop-color="#7754E8"/>
                                </linearGradient>
                                <linearGradient id="learnCapGradient" x1="62" y1="28" x2="121" y2="62" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#9669FF"/>
                                    <stop offset="1" stop-color="#552BE0"/>
                                </linearGradient>
                            </defs>
                            <ellipse cx="92" cy="72" rx="74" ry="43" fill="#E9E3FF"/>
                            <ellipse cx="46" cy="70" rx="24" ry="24" fill="#F2EEFF"/>
                            <ellipse cx="137" cy="72" rx="23" ry="24" fill="#F2EEFF"/>
                            <path d="m50 88 47-8 29 11-48 12-28-15Z" fill="#6844D9"/>
                            <path d="m52 79 46-8 28 11-48 12-26-15Z" fill="url(#learnBookGradient)"/>
                            <path d="m52 69 44-8 30 10-46 10-28-12Z" fill="#D7CBFF"/>
                            <path d="m59 61 38-7 24 8-40 8-22-9Z" fill="#8C6AF1"/>
                            <path d="m58 43 34-17 42 13-35 19-41-15Z" fill="url(#learnCapGradient)"/>
                            <path d="m92 59 1 11c0 5 7 6 8 1l2-12" stroke="#5736C4" stroke-width="3" stroke-linecap="round"/>
                            <path d="m92 43 1 9" stroke="#D7CBFF" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="92" cy="43" r="3" fill="#fff"/>
                        </svg>
                    </div>
                    <div class="job-feature-card__body">
                        <span class="job-feature-card__accent" aria-hidden="true"></span>
                        <div>
                            <h3>Learn</h3>
                            <p>Track your strengths and follow personalized recommendations to keep growing your skills.</p>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <article class="job-feature-card job-feature-card--build">
                    <div class="job-feature-card__art">
                        <svg viewBox="0 0 180 130" fill="none" aria-hidden="true">
                            <defs>
                                <linearGradient id="buildPageGradient" x1="54" y1="18" x2="121" y2="106" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#fff"/>
                                    <stop offset="1" stop-color="#E9E4FF"/>
                                </linearGradient>
                                <linearGradient id="buildUploadGradient" x1="107" y1="73" x2="148" y2="110" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#9B75FF"/>
                                    <stop offset="1" stop-color="#6039DB"/>
                                </linearGradient>
                            </defs>
                            <ellipse cx="89" cy="74" rx="76" ry="43" fill="#ECE7FF"/>
                            <ellipse cx="42" cy="74" rx="22" ry="23" fill="#F5F2FF"/>
                            <ellipse cx="138" cy="73" rx="23" ry="23" fill="#F5F2FF"/>
                            <path d="M53 22a8 8 0 0 1 8-8h57l22 22v63a8 8 0 0 1-8 8H61a8 8 0 0 1-8-8V22Z" fill="url(#buildPageGradient)" stroke="#C9BBFF" stroke-width="3"/>
                            <path d="M117 15v23h22" stroke="#C9BBFF" stroke-width="3" stroke-linejoin="round"/>
                            <rect x="66" y="39" width="25" height="25" rx="6" fill="#8A6BEF"/>
                            <circle cx="78.5" cy="47" r="4.5" fill="#fff"/>
                            <path d="M70 59c1-5 4-7 8.5-7s7.5 2 9 7" stroke="#fff" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M99 43h19M99 54h14M67 76h49M67 86h35" stroke="#A99AE2" stroke-width="4" stroke-linecap="round"/>
                            <circle cx="126" cy="89" r="20" fill="url(#buildUploadGradient)"/>
                            <path d="M126 99V79m0 0-7 7m7-7 7 7" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="job-feature-card__body">
                        <span class="job-feature-card__accent" aria-hidden="true"></span>
                        <div>
                            <h3>Build</h3>
                            <p>Create a standout profile and improve your resume with AI-powered insights.</p>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <article class="job-feature-card job-feature-card--hired">
                    <div class="job-feature-card__art">
                        <svg viewBox="0 0 180 130" fill="none" aria-hidden="true">
                            <defs>
                                <linearGradient id="hiredRocketGradient" x1="77" y1="24" x2="126" y2="85" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#B39BFF"/>
                                    <stop offset="1" stop-color="#653CE6"/>
                                </linearGradient>
                                <linearGradient id="hiredCheckGradient" x1="118" y1="77" x2="153" y2="110" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#55D9A0"/>
                                    <stop offset="1" stop-color="#1BAA75"/>
                                </linearGradient>
                            </defs>
                            <ellipse cx="87" cy="78" rx="75" ry="40" fill="#EAE5FF"/>
                            <ellipse cx="39" cy="77" rx="24" ry="22" fill="#F4F0FF"/>
                            <ellipse cx="136" cy="79" rx="25" ry="22" fill="#F4F0FF"/>
                            <path d="M73 80c-4-17 7-43 34-59 8 20 7 45-9 61l-25-2Z" fill="url(#hiredRocketGradient)"/>
                            <path d="m73 80-16 7 8-20M98 82l-3 19 16-14" fill="#7856E8"/>
                            <circle cx="98" cy="50" r="8" fill="#E9E2FF" stroke="#5632D0" stroke-width="4"/>
                            <path d="m78 83-8 12 14-7m20-20 12-8-7 14" stroke="#FFC96B" stroke-width="5" stroke-linecap="round"/>
                            <circle cx="139" cy="91" r="20" fill="url(#hiredCheckGradient)"/>
                            <path d="m130 91 6 6 12-14" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="m52 37 2 6 6 2-6 2-2 6-2-6-6-2 6-2 2-6Zm86-18 2 5 5 2-5 2-2 5-2-5-5-2 5-2 2-5Z" fill="#A68CFF"/>
                        </svg>
                    </div>
                    <div class="job-feature-card__body">
                        <span class="job-feature-card__accent" aria-hidden="true"></span>
                        <div>
                            <h3>Get Hired</h3>
                            <p>Find suitable roles, track your applications, and prepare for interviews with confidence.</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="profile-intelligence-section" aria-labelledby="profile-intelligence-title">
    <div class="container">
        <div class="row align-items-center g-5 profile-intelligence-layout">
            <div class="col-lg-6">
                <div class="profile-intelligence-copy">
                    <span class="profile-intelligence-badge">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="m12 3 8 4.5-8 4.5-8-4.5L12 3Z" fill="currentColor"/>
                            <path d="m4 12 8 4.5 8-4.5M4 16.5 12 21l8-4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Profile Intelligence
                    </span>
                    <h2 id="profile-intelligence-title">Get smarter offers from <span>profile analysis</span></h2>
                    <p class="profile-intelligence-lead">Let AI analyze your experience, skills, and goals to surface relevant opportunities for your next move.</p>

                    <ul class="profile-intelligence-benefits">
                        <li>
                            <span class="profile-intelligence-benefit-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.2 2.8 5.5 13h5l-.8 8.2L18.5 11h-5.2l-.1-8.2Z"/></svg>
                            </span>
                            <span>Match your experience and skills to suitable roles</span>
                        </li>
                        <li>
                            <span class="profile-intelligence-benefit-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M4 19V9m5 10V5m5 14v-7m5 7V3" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
                            </span>
                            <span>Get recommendations informed by your resume</span>
                        </li>
                        <li>
                            <span class="profile-intelligence-benefit-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span>Keep applications and interview preparation in one workflow</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="profile-intelligence-visual">
                    <div class="profile-matches-card">
                        <header class="profile-matches-card__header">
                            <div>
                                <h3>Your Matches</h3>
                                <p>Role recommendations from your resume analysis</p>
                            </div>
                            <a href="{{ auth()->check() ? route('ai-analysis.index') : route('login') }}" class="profile-matches-card__view-all">
                                View All <span aria-hidden="true">→</span>
                            </a>
                        </header>

                        @if($workflowRecommendations)
                            <div class="profile-match-list">
                                @foreach($workflowRecommendations as $index => $recommendation)
                                    <article class="profile-match">
                                        <span class="profile-match__icon profile-match__icon--{{ $index }}" aria-hidden="true">
                                            <svg viewBox="0 0 24 24" fill="none">
                                                @if($index === 1)
                                                    <path d="m8 8-4 4 4 4m8-8 4 4-4 4m-3-11-2 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                @elseif($index === 2)
                                                    <path d="M3 9.5 12 5l9 4.5-9 4.5-9-4.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                                    <path d="M7 12v4c2.8 2.1 7.2 2.1 10 0v-4M21 10v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                                @else
                                                    <rect x="3.5" y="7.5" width="17" height="13" rx="2" stroke="currentColor" stroke-width="1.8"/>
                                                    <path d="M9 7.5V5.8A1.8 1.8 0 0 1 10.8 4h2.4A1.8 1.8 0 0 1 15 5.8v1.7M8 12h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                                @endif
                                            </svg>
                                        </span>
                                        <div class="profile-match__details">
                                            <strong>
                                                <a href="{{ route('jobs.index', ['job_title' => $recommendation['role_title']]) }}">{{ $recommendation['role_title'] }}</a>
                                            </strong>
                                            <p>{{ $recommendation['explanation'] ?? 'Recommended from your resume analysis.' }}</p>
                                        </div>
                                        @if(isset($recommendation['match_percentage']) && is_numeric($recommendation['match_percentage']) && $recommendation['match_percentage'] >= 0 && $recommendation['match_percentage'] <= 100)
                                            <span class="profile-match__score">{{ (int) round($recommendation['match_percentage']) }}% Match</span>
                                        @else
                                            <span class="profile-match__score profile-match__score--recommended">Recommended</span>
                                        @endif
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <div class="profile-matches-empty">
                                <span class="profile-matches-empty__icon" aria-hidden="true">
                                    <svg viewBox="0 0 48 48" fill="none">
                                        <path d="M15 5h13l9 9v25a3 3 0 0 1-3 3H15a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                        <path d="M28 6v9h9M18 25h13M18 31h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <strong>{{ $workflowRecommendations === null ? 'Sign in to see your tailored matches' : 'Your matches will appear here' }}</strong>
                                <p>{{ $workflowRecommendations === null ? 'Your profile-based recommendations are available with your account.' : 'Analyze a resume to get role recommendations based on your experience and skills.' }}</p>
                                <a href="{{ auth()->check() ? route('ai-analysis.index') : route('login') }}">
                                    {{ $workflowRecommendations === null ? 'Sign In' : 'Analyze Resume' }}
                                    <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="how-it-works-section" aria-labelledby="how-it-works-title">
    <div class="container">
        <div class="how-it-works-shell">
            <header class="how-it-works-heading">
                <span class="how-it-works-kicker">
                    <span class="how-it-works-kicker__icon" aria-hidden="true">✦</span>
                    How it works
                </span>
                <h2 id="how-it-works-title">Your Career Journey, <span>Simplified.</span></h2>
                <p>Three simple steps to move closer to your next opportunity.</p>
            </header>

            <div class="row g-4 how-it-works-grid">
                <div class="col-md-4">
                    <article class="how-step-card">
                        <div class="how-step-card__art how-step-card__art--profile">
                            <span class="how-step-card__number">01</span>
                            <svg viewBox="0 0 96 96" fill="none" aria-hidden="true">
                                <circle cx="48" cy="48" r="44" fill="currentColor" opacity=".1"/>
                                <circle cx="48" cy="36" r="14" fill="currentColor" opacity=".78"/>
                                <path d="M22 78c2.8-14.2 12.2-21 26-21s23.2 6.8 26 21" fill="currentColor" opacity=".78"/>
                                <circle cx="73" cy="72" r="14" fill="#fff"/>
                                <path d="M73 65v14M66 72h14" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="how-step-card__copy">
                            <h3>Create your profile</h3>
                            <p>Add your experience, skills, and goals to build a clear professional profile.</p>
                        </div>
                        <a class="how-step-card__action" href="{{ auth()->check() ? route('profile.index') : route('login') }}">
                            Go to Profile <span aria-hidden="true">→</span>
                        </a>
                    </article>
                </div>

                <div class="col-md-4">
                    <article class="how-step-card">
                        <div class="how-step-card__art how-step-card__art--resume">
                            <span class="how-step-card__number">02</span>
                            <svg viewBox="0 0 96 96" fill="none" aria-hidden="true">
                                <circle cx="48" cy="48" r="44" fill="currentColor" opacity=".1"/>
                                <path d="M29 19h27l15 15v42a4 4 0 0 1-4 4H29a4 4 0 0 1-4-4V23a4 4 0 0 1 4-4Z" fill="#fff" stroke="currentColor" stroke-width="3"/>
                                <path d="M56 20v16h15M36 48h27M36 58h27M36 68h16" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                                <circle cx="68" cy="68" r="14" fill="currentColor"/>
                                <path d="m68 60 2.4 5 5.6.8-4 3.9.9 5.5-4.9-2.6-4.9 2.6.9-5.5-4-3.9 5.6-.8 2.4-5Z" fill="#fff"/>
                            </svg>
                        </div>
                        <div class="how-step-card__copy">
                            <h3>Improve your story</h3>
                            <p>Use AI coaching to improve your resume and sharpen the way you present your skills.</p>
                        </div>
                        <a class="how-step-card__action" href="{{ auth()->check() ? route('ai-analysis.index') : route('login') }}">
                            Analyze Resume <span aria-hidden="true">→</span>
                        </a>
                    </article>
                </div>

                <div class="col-md-4">
                    <article class="how-step-card">
                        <div class="how-step-card__art how-step-card__art--jobs">
                            <span class="how-step-card__number">03</span>
                            <svg viewBox="0 0 96 96" fill="none" aria-hidden="true">
                                <circle cx="48" cy="48" r="44" fill="currentColor" opacity=".1"/>
                                <rect x="17" y="35" width="62" height="43" rx="8" fill="currentColor"/>
                                <path d="M34 35v-8a5 5 0 0 1 5-5h18a5 5 0 0 1 5 5v8M17 51c9 5 20 7 31 7s22-2 31-7" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="70" cy="70" r="14" fill="#fff"/>
                                <path d="m63 70 5 5 9-10" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="how-step-card__copy">
                            <h3>Apply with focus</h3>
                            <p>Track your applications and move toward the right opportunities with more clarity.</p>
                        </div>
                        <a class="how-step-card__action" href="{{ auth()->check() ? route('jobs.index') : route('login') }}">
                            Browse Jobs <span aria-hidden="true">→</span>
                        </a>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="live-platform-activity-section" aria-labelledby="live-platform-activity-title">
    <div class="container">
        <header class="live-platform-activity-heading">
            <span class="live-platform-activity-kicker">
                <span class="live-platform-activity-kicker__dot" aria-hidden="true"></span>
                Live Insights
            </span>
            <h2 id="live-platform-activity-title">Live Platform Activity</h2>
            <p>Real engagement across CareerPilot, calculated from member activity.</p>
        </header>

        <div class="row g-4 live-platform-activity-grid">
            @foreach($livePlatformMetrics as $metric)
                <div class="col-12 col-sm-6 col-xl-3">
                    <article class="live-insight-card live-insight-card--{{ $metric['key'] }}">
                        <div class="live-insight-card__heading">
                            <span class="live-insight-card__icon" aria-hidden="true">
                                @switch($metric['key'])
                                    @case('resume-completion')
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M7 3.8h7l4 4V20a1.2 1.2 0 0 1-1.2 1.2H7A1.2 1.2 0 0 1 5.8 20V5A1.2 1.2 0 0 1 7 3.8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                            <path d="M14 4v4h4M9 12h6M9 16h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        </svg>
                                        @break
                                    @case('applications')
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <rect x="3.5" y="7.5" width="17" height="13" rx="2" stroke="currentColor" stroke-width="1.8"/>
                                            <path d="M9 7.5V5.8A1.8 1.8 0 0 1 10.8 4h2.4A1.8 1.8 0 0 1 15 5.8v1.7M8 12h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        </svg>
                                        @break
                                    @case('interview-practice')
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M12 15a4 4 0 0 0 4-4V7a4 4 0 0 0-8 0v4a4 4 0 0 0 4 4Z" stroke="currentColor" stroke-width="1.8"/>
                                            <path d="M5 11a7 7 0 0 0 14 0M12 18v3M9 21h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        </svg>
                                        @break
                                    @default
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="m12 3 1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8L12 3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                            <path d="m19 15 .9 2.1L22 18l-2.1.9L19 21l-.9-2.1L16 18l2.1-.9L19 15Z" fill="currentColor"/>
                                        </svg>
                                @endswitch
                            </span>
                            <div>
                                <h3>{{ $metric['title'] }}</h3>
                                <p>{{ $metric['description'] }}</p>
                            </div>
                        </div>

                        <div class="live-insight-card__progress">
                            @if($metric['percentage'] !== null)
                                <div
                                    class="live-insight-ring"
                                    role="progressbar"
                                    aria-label="{{ $metric['title'] }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                    aria-valuenow="{{ $metric['percentage'] }}"
                                    style="--progress: {{ $metric['percentage'] }}%;"
                                >
                                    <span>{{ $metric['percentage'] }}%</span>
                                </div>
                                <p>{{ number_format($metric['member_count']) }} of {{ number_format($platformStats['users']) }} members</p>
                            @else
                                <div class="live-insight-ring live-insight-ring--empty" role="img" aria-label="No platform data available">
                                    <span>—</span>
                                </div>
                                <p>No registered members yet</p>
                            @endif
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="recent-platform-activity" aria-labelledby="recent-activity-title">
    <div class="container">
        <header class="recent-activity-heading">
            <span class="recent-activity-kicker">
                <span class="recent-activity-kicker__dot" aria-hidden="true"></span>
                Platform pulse
            </span>
            <h2 id="recent-activity-title">Recent Platform Activity</h2>
            <p>Real people, resumes, and applications moving careers forward.</p>
        </header>

        <div class="row g-4 recent-activity-grid">
            <div class="col-md-6 col-xl-4">
                <article class="activity-card activity-card--users">
                    <div class="activity-card__heading">
                        <span class="activity-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M16 20v-1.6a3.4 3.4 0 0 0-3.4-3.4H6.4A3.4 3.4 0 0 0 3 18.4V20M9.5 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM16 4.2a3.5 3.5 0 0 1 0 6.8m2 4h.6a3.4 3.4 0 0 1 3.4 3.4V20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div class="activity-card__title">
                            <h3>Users</h3>
                            <p>Latest community members</p>
                        </div>
                        <span class="activity-card__count">{{ number_format($platformStats['users']) }}</span>
                    </div>

                    <div class="activity-card__content">
                        @forelse($recentUsers->take(1) as $user)
                            @php
                                $profileImage = $user->profile?->profile_image;
                                $profileImageUrl = $profileImage
                                    ? (\Illuminate\Support\Str::startsWith($profileImage, ['https://', 'http://'])
                                        ? $profileImage
                                        : \Illuminate\Support\Facades\Storage::disk('public')->url($profileImage))
                                    : null;
                            @endphp
                            <div class="activity-user">
                                @if($profileImageUrl)
                                    <img class="activity-user__avatar" src="{{ $profileImageUrl }}" alt="{{ $user->name }}'s profile photo" loading="lazy">
                                @else
                                    <span class="activity-user__avatar activity-user__avatar--initials" aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($user->name, 0, 1)) }}</span>
                                @endif
                                <div class="activity-user__details">
                                    <strong>{{ $user->name }}</strong>
                                    <span>{{ $user->email }}</span>
                                    @if($user->created_at)
                                        <time datetime="{{ $user->created_at->toIso8601String() }}">Joined {{ $user->created_at->diffForHumans() }}</time>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="activity-empty-state">
                                <span class="activity-empty-state__icon" aria-hidden="true">
                                    <svg viewBox="0 0 48 48" fill="none">
                                        <circle cx="24" cy="17" r="7" stroke="currentColor" stroke-width="2"/>
                                        <path d="M10 40v-3a10 10 0 0 1 10-10h8a10 10 0 0 1 10 10v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <strong>No recent members yet</strong>
                                <span>New community members will show up here.</span>
                            </div>
                        @endforelse
                    </div>

                    <div class="activity-card__footer">
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}">View All Users <span aria-hidden="true">→</span></a>
                        @elseif(auth()->check())
                            <a href="{{ route('dashboard') }}">Open Dashboard <span aria-hidden="true">→</span></a>
                        @else
                            <a href="{{ route('login') }}">Join CareerPilot <span aria-hidden="true">→</span></a>
                        @endif
                    </div>
                </article>
            </div>

            <div class="col-md-6 col-xl-4">
                <article class="activity-card activity-card--resumes">
                    <div class="activity-card__heading">
                        <span class="activity-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M7 3.8h7l4 4V20a1.2 1.2 0 0 1-1.2 1.2H7A1.2 1.2 0 0 1 5.8 20V5A1.2 1.2 0 0 1 7 3.8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                <path d="M14 4v4h4M9 12h6M9 16h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <div class="activity-card__title">
                            <h3>Resumes</h3>
                            <p>Recently uploaded</p>
                        </div>
                        <span class="activity-card__count">{{ number_format($platformStats['resumes']) }}</span>
                    </div>

                    <div class="activity-card__content">
                        @forelse($recentResumes->take(2) as $resume)
                            <div class="activity-record">
                                <span class="activity-record__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path d="M7 3.8h7l4 4V20a1.2 1.2 0 0 1-1.2 1.2H7A1.2 1.2 0 0 1 5.8 20V5A1.2 1.2 0 0 1 7 3.8Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                                        <path d="M14 4v4h4M9 12h6M9 16h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <div class="activity-record__details">
                                    <strong>{{ $resume->title ?: ($resume->original_name ?: 'Untitled resume') }}</strong>
                                    <span>{{ $resume->user?->name ?? 'Account unavailable' }}</span>
                                    @if($resume->created_at)
                                        <time datetime="{{ $resume->created_at->toIso8601String() }}">{{ $resume->created_at->diffForHumans() }}</time>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="activity-empty-state">
                                <span class="activity-empty-state__icon" aria-hidden="true">
                                    <svg viewBox="0 0 48 48" fill="none">
                                        <path d="M15 5h13l9 9v25a3 3 0 0 1-3 3H15a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                        <path d="M28 6v9h9M18 25h13M18 31h13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <strong>No recent resume activity yet</strong>
                                <span>Uploaded resumes will appear here.</span>
                            </div>
                        @endforelse
                    </div>

                    <div class="activity-card__footer">
                        <a href="{{ auth()->check() ? route('resumes.index') : route('login') }}">View Resumes <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            </div>

            <div class="col-md-6 col-xl-4">
                <article class="activity-card activity-card--jobs">
                    <div class="activity-card__heading">
                        <span class="activity-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <rect x="3.5" y="7.5" width="17" height="13" rx="2" stroke="currentColor" stroke-width="1.8"/>
                                <path d="M9 7.5V5.8A1.8 1.8 0 0 1 10.8 4h2.4A1.8 1.8 0 0 1 15 5.8v1.7M3.8 12.5c2.4 1.6 5.5 2.4 8.2 2.4s5.8-.8 8.2-2.4M12 12v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div class="activity-card__title">
                            <h3>Jobs</h3>
                            <p>Recent applications</p>
                        </div>
                        <span class="activity-card__count">{{ number_format($platformStats['applications']) }}</span>
                    </div>

                    <div class="activity-card__content">
                        @forelse($recentApplications->take(2) as $application)
                            <div class="activity-record">
                                <span class="activity-record__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <rect x="3.5" y="7.5" width="17" height="13" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                        <path d="M9 7.5V5.8A1.8 1.8 0 0 1 10.8 4h2.4A1.8 1.8 0 0 1 15 5.8v1.7M3.8 12.5c2.4 1.6 5.5 2.4 8.2 2.4s5.8-.8 8.2-2.4M12 12v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <div class="activity-record__details">
                                    <strong>{{ $application->job_title }}</strong>
                                    <span>{{ $application->company_name }}</span>
                                    @php($activityDate = $application->applied_at ?? $application->created_at)
                                    @if($activityDate)
                                        <time datetime="{{ $activityDate->toIso8601String() }}">{{ $activityDate->diffForHumans() }}</time>
                                    @endif
                                </div>
                                <span class="activity-record__status">{{ $application->status }}</span>
                            </div>
                        @empty
                            <div class="activity-empty-state">
                                <span class="activity-empty-state__icon" aria-hidden="true">
                                    <svg viewBox="0 0 48 48" fill="none">
                                        <rect x="6" y="14" width="36" height="27" rx="4" stroke="currentColor" stroke-width="2"/>
                                        <path d="M18 14V9a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v5M6.5 24c5.1 3.2 11.1 4.8 17.5 4.8S36.4 27.2 41.5 24M24 23v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <strong>No recent application activity yet</strong>
                                <span>New job applications will appear here.</span>
                            </div>
                        @endforelse
                    </div>

                    <div class="activity-card__footer">
                        <a href="{{ auth()->check() ? route('jobs.index') : route('login') }}">View Applications <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="career-growth-glance" aria-labelledby="career-growth-title">
    <div class="container">
        <div class="career-growth-panel">
            <div class="career-growth-intro">
                <span class="career-growth-trophy" aria-hidden="true">
                    <svg viewBox="0 0 72 72" fill="none">
                        <path d="M22 14h28v12c0 12-5.7 19-14 19s-14-7-14-19V14Z" fill="currentColor" opacity=".95"/>
                        <path d="M22 20h-8v5c0 8 4 13 12 14M50 20h8v5c0 8-4 13-12 14M36 45v10M27 58h18" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="m36 18 2.2 4.5 5 .7-3.6 3.5.9 5-4.5-2.4-4.5 2.4.9-5-3.6-3.5 5-.7L36 18Z" fill="#fff"/>
                    </svg>
                </span>
                <div class="career-growth-intro__copy">
                    <span class="career-growth-kicker">Your career growth</span>
                    <h2 id="career-growth-title">Your Career Growth at a Glance</h2>
                    <p>Track your progress, build new skills, and keep moving toward your career goals.</p>
                    @unless($careerStats)
                        <a class="career-growth-signin" href="{{ route('login') }}">Sign in to view your progress <span aria-hidden="true">→</span></a>
                    @endunless
                </div>
            </div>

            <div class="career-growth-metrics">
                <article class="career-growth-metric">
                    <span class="career-growth-metric__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><rect x="3.5" y="7.5" width="17" height="13" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M9 7.5V5.8A1.8 1.8 0 0 1 10.8 4h2.4A1.8 1.8 0 0 1 15 5.8v1.7M8 12h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    </span>
                    @if($careerStats)
                        <strong>{{ number_format($careerStats['applications']) }}</strong>
                        <span class="career-growth-metric__label">Total Applications</span>
                        <small>Your tracked applications</small>
                    @else
                        <strong class="career-growth-metric__empty">—</strong>
                        <span class="career-growth-metric__label">Total Applications</span>
                        <small>Sign in to view your data</small>
                    @endif
                </article>

                <article class="career-growth-metric">
                    <span class="career-growth-metric__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><rect x="4" y="5" width="16" height="16" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M8 3v4M16 3v4M4 10h16M8 14h3M8 17h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    </span>
                    @if($careerStats)
                        <strong>{{ number_format($careerStats['interviews']) }}</strong>
                        <span class="career-growth-metric__label">Interviews</span>
                        <small>Practice sessions</small>
                    @else
                        <strong class="career-growth-metric__empty">—</strong>
                        <span class="career-growth-metric__label">Interviews</span>
                        <small>Sign in to view your data</small>
                    @endif
                </article>

                <article class="career-growth-metric">
                    <span class="career-growth-metric__icon career-growth-metric__icon--star" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="m12 2.8 2.8 5.7 6.3.9-4.6 4.5 1.1 6.3-5.6-3-5.6 3 1.1-6.3-4.6-4.5 6.3-.9L12 2.8Z"/></svg>
                    </span>
                    @if($careerStats && $careerStats['jobMatch'] !== null)
                        <strong>{{ $careerStats['jobMatch'] }}%</strong>
                        <span class="career-growth-metric__label">Job Match Score</span>
                        <small>From your latest AI analysis</small>
                    @else
                        <strong class="career-growth-metric__empty">—</strong>
                        <span class="career-growth-metric__label">Job Match Score</span>
                        <small>{{ $careerStats ? 'Analyze a resume to see your score' : 'Sign in to view your data' }}</small>
                    @endif
                </article>

                <article class="career-growth-metric">
                    <span class="career-growth-metric__icon career-growth-metric__icon--growth" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M4 18.5 9 13l3.5 3.5L20 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.5 8H20v4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    @if($careerStats && $careerStats['growth'] !== null)
                        <strong>{{ $careerStats['growth'] > 0 ? '+' : '' }}{{ $careerStats['growth'] }} pts</strong>
                        <span class="career-growth-metric__label">Career Growth</span>
                        <small>Resume score change</small>
                    @else
                        <strong class="career-growth-metric__empty">—</strong>
                        <span class="career-growth-metric__label">Career Growth</span>
                        <small>{{ $careerStats ? 'Complete 2 analyses to track change' : 'Sign in to view your data' }}</small>
                    @endif
                </article>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <div class="card-soft p-4 p-xl-5 h-100" style="background: linear-gradient(135deg, rgba(124, 92, 255, 0.08), rgba(59, 130, 246, 0.05)); border-color: rgba(124, 92, 255, 0.15);">
                    <span class="hero-badge">Keep learning. Stay premium.</span>
                    <h2 class="section-title mt-3 mb-3">Build momentum with consistent, smarter career growth.</h2>
                    <p class="text-secondary-custom mb-4">From your first resume draft to your next interview round, CareerPilot keeps your job-search system organized, premium, and easier to trust.</p>

                    <div class="d-flex flex-wrap gap-3">
                        <span class="premium-mini-tag">AI coaching</span>
                        <span class="premium-mini-tag">Career clarity</span>
                        <span class="premium-mini-tag">Application focus</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-panel card-soft p-4 p-xl-5">
                    <div class="dark-panel-top mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-badge">CP</div>
                            <div>
                                <div class="small text-white-50">Career profile</div>
                                <strong class="fs-6 text-white">Ready for next move</strong>
                            </div>
                        </div>
                        <span class="status-pill">On track</span>
                    </div>

                    <div class="dark-score-card mb-3">
                        <div class="d-flex justify-content-between small text-white-50 mb-2">
                            <span>Resume readiness</span>
                            <span class="fw-bold text-white">Strong</span>
                        </div>
                        <div class="progress dark-progress" style="height: 12px;">
                            <div class="progress-bar bg-primary-custom" style="width: 82%"></div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-4">
                            <div class="stat-card h-100">
                                <div class="small text-secondary-custom">Profiles</div>
                                <div class="fs-4 fw-bold">Live</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-card h-100">
                                <div class="small text-secondary-custom">Applications</div>
                                <div class="fs-4 fw-bold">Tracked</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-card h-100">
                                <div class="small text-secondary-custom">Prep</div>
                                <div class="fs-4 fw-bold">Ready</div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded-4 p-3 bg-white">
                        <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                            <div>
                                <div class="fw-semibold">Product Analyst</div>
                                <div class="small text-secondary-custom">Target role</div>
                            </div><span class="badge bg-primary rounded-pill px-2 py-1">In review</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <div>
                                <div class="fw-semibold">Frontend Engineer</div>
                                <div class="small text-secondary-custom">Second track</div>
                            </div><span class="badge bg-warning text-dark rounded-pill px-2 py-1">Preparing</span>
                        </div>
                    </div>

                    <div class="quick-action-row mt-3 d-flex flex-wrap gap-2"><span class="premium-mini-tag">Tailored resume</span><span class="premium-mini-tag">AI feedback</span><span class="premium-mini-tag">Interview drills</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="public-cta py-5">
    <div class="container">
        <div class="cta-panel text-center">
            <div class="mb-3 d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill" style="background: rgba(124, 92, 255, 0.08); color: #4f46e5; border: 1px solid rgba(124, 92, 255, 0.15); font-weight: 700;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #4f46e5; display: inline-block;"></span>
                Career momentum starts here
            </div>
            <h2 class="section-title mb-3">Ready to grow your career?</h2>
            <p class="text-secondary-custom mb-4">Build a stronger profile, land better opportunities, and move faster with CareerPilot AI.</p>
            <a href="{{ route('register') }}" class="btn btn-primary-custom text-white px-4 py-3">Start Your Career Growth Plan</a>
        </div>
    </div>
</section>

@endsection