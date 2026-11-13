@extends('layouts.public')

@section('title', 'CareerPilot AI | Your AI-Powered Career Growth Partner')

@section('content')
<section class="public-home-hero py-5 py-lg-6 bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="hero-badge">Career growth, reimagined</span>
                <h1 class="hero-title mt-3">Build a stronger career with clarity.</h1>
                <p class="lead text-secondary-custom mt-4 mb-4">CareerPilot AI helps you organize applications, improve your resume, prepare for interviews, and track the progress that moves your career forward.</p>

                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="{{ route('register') }}" class="btn btn-primary-custom text-white px-4 py-3">Get Started</a>
                    <a href="{{ route('features') }}" class="btn btn-outline-custom px-4 py-3">Explore Features</a>
                </div>

                <div class="hero-metrics d-flex flex-wrap align-items-center gap-3 text-secondary-custom small">
                    <span class="hero-metric-pill">Profile-first workflow</span>
                    <span class="hero-metric-pill">AI resume feedback</span>
                    <span class="hero-metric-pill">Interview readiness</span>
                </div>

                <div class="hero-feature-strip mt-4 d-flex flex-wrap gap-3">
                    <div class="hero-highlight-card">
                        <span class="mini-dot"></span>
                        <span>Resume scoring</span>
                    </div>
                    <div class="hero-highlight-card">
                        <span class="mini-dot"></span>
                        <span>Applications tracked</span>
                    </div>
                    <div class="hero-highlight-card">
                        <span class="mini-dot"></span>
                        <span>Interview prep</span>
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
                            </div>
                            <span class="badge bg-primary rounded-pill px-2 py-1">In review</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <div>
                                <div class="fw-semibold">Frontend Engineer</div>
                                <div class="small text-secondary-custom">Second track</div>
                            </div>
                            <span class="badge bg-warning text-dark rounded-pill px-2 py-1">Preparing</span>
                        </div>
                    </div>

                    <div class="quick-action-row mt-3 d-flex flex-wrap gap-2">
                        <span class="premium-mini-tag">Tailored resume</span>
                        <span class="premium-mini-tag">AI feedback</span>
                        <span class="premium-mini-tag">Interview drills</span>
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

<section class="py-5 bg-soft-blue">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Built for smarter job search</h2>
            <p class="text-secondary-custom mx-auto" style="max-width: 720px;">Everything you need to stay focused, competitive, and ready for the next opportunity.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card-soft feature-card p-4 h-100">
                    <div class="feature-icon">AI</div>
                    <h5 class="fw-bold">AI resume insights</h5>
                    <p class="text-secondary-custom mb-0">Get ATS-aware feedback, skill gaps, and action plans that improve every application.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card-soft feature-card p-4 h-100">
                    <div class="feature-icon">SK</div>
                    <h5 class="fw-bold">Skill growth</h5>
                    <p class="text-secondary-custom mb-0">Track your strengths, measure your progress, and build a profile that stands out.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card-soft feature-card p-4 h-100">
                    <div class="feature-icon">IP</div>
                    <h5 class="fw-bold">Interview prep</h5>
                    <p class="text-secondary-custom mb-0">Practice realistic questions, sharpen your answers, and improve your confidence.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="section-title">One clear workflow from profile to offer.</h2>
                <p class="text-secondary-custom">CareerPilot brings your resume strategy, skill growth, and interview prep into one focused workflow so your job search feels organized and intentional.</p>
                <ul class="list-unstyled text-secondary-custom mt-4 mb-0">
                    <li class="mb-3"><strong class="d-block text-dark">01.</strong> Build a clear professional profile that reflects your strengths and goals.</li>
                    <li class="mb-3"><strong class="d-block text-dark">02.</strong> Improve your resume and role alignment with AI-supported feedback.</li>
                    <li class="mb-3"><strong class="d-block text-dark">03.</strong> Track applications and practice interviews with better focus and confidence.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="card-soft p-4 p-xl-5">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small text-secondary-custom">Career dashboard</div>
                            <strong class="fs-5">Application progress</strong>
                        </div>
                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(124, 92, 255, 0.1); color: #4f46e5;">Momentum</span>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        <div class="border rounded-4 p-3 bg-white">
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <div class="fw-semibold">Product Analyst</div>
                                    <div class="small text-secondary-custom">Target role</div>
                                </div>
                                <span class="badge bg-primary rounded-pill px-2 py-1">Reviewing</span>
                            </div>
                        </div>

                        <div class="border rounded-4 p-3 bg-white">
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <div class="fw-semibold">UX Researcher</div>
                                    <div class="small text-secondary-custom">Secondary role</div>
                                </div>
                                <span class="badge bg-success rounded-pill px-2 py-1">Strong</span>
                            </div>
                        </div>

                        <div class="border rounded-4 p-3 bg-white">
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <div class="fw-semibold">Frontend Engineer</div>
                                    <div class="small text-secondary-custom">Active pipeline</div>
                                </div>
                                <span class="badge bg-warning text-dark rounded-pill px-2 py-1">Prep</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-soft-blue">
    <div class="container">
        <div class="how-it-works-shell">
            <div class="text-center mb-5">
                <span class="how-it-works-kicker">HOW IT WORKS</span>
                <h2 class="section-title mb-2">Your career journey, simplified.</h2>
                <p class="text-secondary-custom mx-auto" style="max-width: 620px;">Three simple steps to move closer to your next opportunity.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="how-it-step">
                        <div class="step-circle step-circle--purple">
                            <span>01</span>
                        </div>
                        <div class="step-icon">👤</div>
                        <h5>Create your profile</h5>
                        <p>Add your experience, skills, and goals to build a clear professional profile.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="how-it-step">
                        <div class="step-circle step-circle--blue">
                            <span>02</span>
                        </div>
                        <div class="step-icon">✦</div>
                        <h5>Improve your story</h5>
                        <p>Use AI coaching to improve your resume and sharpen the way you present your skills.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="how-it-step">
                        <div class="step-circle step-circle--green">
                            <span>03</span>
                        </div>
                        <div class="step-icon">◎</div>
                        <h5>Apply with focus</h5>
                        <p>Track your applications and move toward the right opportunities with more clarity.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Live platform activity</h2>
            <p class="text-secondary-custom mx-auto" style="max-width: 720px;">Real users, resumes, applications, and AI insights are being created across the platform every day.</p>
        </div>

        <div class="metric-showcase-panel">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="metric-showcase-card">
                        <div class="metric-ring metric-ring--purple" style="--percent: 70;">
                            <span>70%</span>
                        </div>
                        <div class="metric-showcase-copy">
                            <h4>Resume completion</h4>
                            <small>70% completed</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5">
                    <div class="metric-showcase-card">
                        <div class="metric-ring metric-ring--blue" style="--percent: 45;">
                            <span>45%</span>
                        </div>
                        <div class="metric-showcase-copy">
                            <h4>Applications</h4>
                            <small>45% completed</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5">
                    <div class="metric-showcase-card">
                        <div class="metric-ring metric-ring--green" style="--percent: 85;">
                            <span>85%</span>
                        </div>
                        <div class="metric-showcase-copy">
                            <h4>Interview practice</h4>
                            <small>85% completed</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5">
                    <div class="metric-showcase-card">
                        <div class="metric-ring metric-ring--orange" style="--percent: 30;">
                            <span>30%</span>
                        </div>
                        <div class="metric-showcase-copy">
                            <h4>AI analysis</h4>
                            <small>30% completed</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-soft-blue">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Recent platform activity</h2>
            <p class="text-secondary-custom mx-auto" style="max-width: 720px;">Fresh user signups, resumes, and job applications from the live CareerPilot platform.</p>
        </div>

        <div class="recent-activity-panel">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4">
                    <div class="activity-block">
                        <div class="activity-block__head">
                            <span class="activity-icon activity-icon--purple">👥</span>
                            <span>Users</span>
                        </div>
                        <h4>New members</h4>
                        @forelse($recentUsers as $user)
                        <div class="activity-item">
                            <div>
                                <strong>{{ $user->name }}</strong>
                                <small>{{ $user->email }}</small>
                            </div>
                            <span>{{ $user->created_at?->diffForHumans() }}</span>
                        </div>
                        @empty
                        <p class="activity-empty">No recent users yet. New members will appear here.</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="activity-block">
                        <div class="activity-block__head">
                            <span class="activity-icon activity-icon--blue">📄</span>
                            <span>Resumes</span>
                        </div>
                        <h4>Resume updates</h4>
                        @forelse($recentResumes as $resume)
                        <div class="activity-item">
                            <div>
                                <strong>{{ $resume->title }}</strong>
                                <small>{{ $resume->user?->name ?? 'Unknown user' }}</small>
                            </div>
                            <span>{{ $resume->created_at?->diffForHumans() }}</span>
                        </div>
                        @empty
                        <p class="activity-empty">Recently uploaded resumes will appear here.</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="activity-block">
                        <div class="activity-block__head">
                            <span class="activity-icon activity-icon--green">💼</span>
                            <span>Jobs</span>
                        </div>
                        <h4>Job applications</h4>
                        @forelse($recentApplications as $application)
                        <div class="activity-item">
                            <div>
                                <strong>{{ $application->job_title }}</strong>
                                <small>{{ $application->company_name }}</small>
                            </div>
                            <span class="activity-badge">{{ $application->status }}</span>
                        </div>
                        @empty
                        <p class="activity-empty">Track the latest job applications here.</p>
                        @endforelse
                    </div>
                </div>
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
                <div class="card-soft p-4 p-xl-5 h-100" style="background: linear-gradient(135deg, #5b4ef7, #7c5cff 48%, #3a5be8); color: white; border: none;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <div class="small text-white-50">Premium learning</div>
                            <strong class="fs-5 text-white">CareerPilot Growth Plan</strong>
                        </div>
                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(255,255,255,0.12); color: white; border: 1px solid rgba(255,255,255,0.2);">Classic + premium</span>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);">
                            <div class="small text-white-50">Resume readiness</div>
                            <div class="fs-4 fw-bold mt-1">82%</div>
                        </div>
                        <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);">
                            <div class="small text-white-50">Application momentum</div>
                            <div class="fs-4 fw-bold mt-1">3 active tracks</div>
                        </div>
                        <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);">
                            <div class="small text-white-50">Interview confidence</div>
                            <div class="fs-4 fw-bold mt-1">Improving weekly</div>
                        </div>
                    </div>
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