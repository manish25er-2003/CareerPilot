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
        <div class="text-center mb-5">
            <h2 class="section-title">How it works</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-soft process-card p-4 text-center h-100">
                    <div class="display-6 mb-3">1</div>
                    <h5 class="fw-bold">Create your profile</h5>
                    <p class="text-secondary-custom mb-0">Add your experience, skills, and goals in a clean profile setup.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-soft process-card p-4 text-center h-100">
                    <div class="display-6 mb-3">2</div>
                    <h5 class="fw-bold">Improve your story</h5>
                    <p class="text-secondary-custom mb-0">Use AI coaching to refine your resume and prepare for interviews.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-soft process-card p-4 text-center h-100">
                    <div class="display-6 mb-3">3</div>
                    <h5 class="fw-bold">Apply with focus</h5>
                    <p class="text-secondary-custom mb-0">Track your pipeline and move confidently through each opportunity.</p>
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

        <div class="row g-4 metric-grid">
            <div class="col-md-6 col-xl-4">
                <div class="metric-card card-soft p-4 h-100 text-center">
                    <div class="metric-ring" data-target="{{ $platformStats['users'] ?? 0 }}" style="--ring-color: #6d5efc; --ring-accent: rgba(109, 94, 252, 0.15);">
                        <div class="metric-ring__inner">
                            <span class="metric-ring__value">0</span>
                        </div>
                    </div>
                    <div class="metric-label">Users</div>
                    <div class="metric-subtitle">Active members</div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="metric-card card-soft p-4 h-100 text-center">
                    <div class="metric-ring" data-target="{{ $platformStats['resumes'] ?? 0 }}" style="--ring-color: #7c3aed; --ring-accent: rgba(124, 58, 237, 0.15);">
                        <div class="metric-ring__inner">
                            <span class="metric-ring__value">0</span>
                        </div>
                    </div>
                    <div class="metric-label">Resumes</div>
                    <div class="metric-subtitle">Uploaded and tracked</div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="metric-card card-soft p-4 h-100 text-center">
                    <div class="metric-ring" data-target="{{ $platformStats['applications'] ?? 0 }}" style="--ring-color: #4f46e5; --ring-accent: rgba(79, 70, 229, 0.15);">
                        <div class="metric-ring__inner">
                            <span class="metric-ring__value">0</span>
                        </div>
                    </div>
                    <div class="metric-label">Applications</div>
                    <div class="metric-subtitle">Jobs in progress</div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="metric-card card-soft p-4 h-100 text-center">
                    <div class="metric-ring" data-target="{{ $platformStats['analyses'] ?? 0 }}" style="--ring-color: #8b5cf6; --ring-accent: rgba(139, 92, 246, 0.15);">
                        <div class="metric-ring__inner">
                            <span class="metric-ring__value">0</span>
                        </div>
                    </div>
                    <div class="metric-label">AI analyses</div>
                    <div class="metric-subtitle">Resume match checks</div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="metric-card card-soft p-4 h-100 text-center">
                    <div class="metric-ring" data-target="{{ $platformStats['activeUsers'] ?? 0 }}" style="--ring-color: #6366f1; --ring-accent: rgba(99, 102, 241, 0.15);">
                        <div class="metric-ring__inner">
                            <span class="metric-ring__value">0</span>
                        </div>
                    </div>
                    <div class="metric-label">Active users</div>
                    <div class="metric-subtitle">Currently enabled</div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="metric-card card-soft p-4 h-100 text-center">
                    <div class="metric-ring" data-target="{{ $platformStats['interviews'] ?? 0 }}" style="--ring-color: #5b4ef7; --ring-accent: rgba(91, 78, 247, 0.15);">
                        <div class="metric-ring__inner">
                            <span class="metric-ring__value">0</span>
                        </div>
                    </div>
                    <div class="metric-label">Interviews</div>
                    <div class="metric-subtitle">Interview sessions</div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rings = document.querySelectorAll('.metric-ring');

        const animateRing = (ring) => {
            const target = Number(ring.dataset.target || 0);
            const valueEl = ring.querySelector('.metric-ring__value');
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const duration = prefersReducedMotion ? 0 : 1200;
            const start = performance.now();

            const tick = (time) => {
                const progress = Math.min((time - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = Math.round(target * eased);
                const percent = Math.min((current / Math.max(target, 1)) * 100, 100);

                ring.style.setProperty('--progress', percent);
                valueEl.textContent = current;

                if (progress < 1) {
                    requestAnimationFrame(tick);
                } else {
                    ring.style.setProperty('--progress', 100);
                    valueEl.textContent = target;
                }
            };

            if (duration === 0) {
                ring.style.setProperty('--progress', 100);
                valueEl.textContent = target;
                return;
            }

            requestAnimationFrame(tick);
        };

        rings.forEach(animateRing);
    });
</script>

<section class="py-5 bg-soft-blue">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Recent platform activity</h2>
            <p class="text-secondary-custom mx-auto" style="max-width: 720px;">Fresh user signups, resumes, and job applications from the live CareerPilot platform.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card-soft p-4 h-100">
                    <h5 class="fw-bold mb-3">New users</h5>
                    @forelse($recentUsers as $user)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <div class="fw-semibold">{{ $user->name }}</div>
                                <div class="small text-secondary-custom">{{ $user->email }}</div>
                            </div>
                            <span class="small text-secondary-custom">{{ $user->created_at?->diffForHumans() }}</span>
                        </div>
                    @empty
                        <div class="text-secondary-custom small">No recent users yet.</div>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-soft p-4 h-100">
                    <h5 class="fw-bold mb-3">Latest resumes</h5>
                    @forelse($recentResumes as $resume)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <div class="fw-semibold">{{ $resume->title }}</div>
                                <div class="small text-secondary-custom">{{ $resume->user?->name ?? 'Unknown user' }}</div>
                            </div>
                            <span class="small text-secondary-custom">{{ $resume->created_at?->diffForHumans() }}</span>
                        </div>
                    @empty
                        <div class="text-secondary-custom small">No recent resumes yet.</div>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-soft p-4 h-100">
                    <h5 class="fw-bold mb-3">Latest applications</h5>
                    @forelse($recentApplications as $application)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <div class="fw-semibold">{{ $application->job_title }}</div>
                                <div class="small text-secondary-custom">{{ $application->company_name }} · {{ $application->user?->name ?? 'Unknown user' }}</div>
                            </div>
                            <span class="badge bg-soft-blue text-primary-custom rounded-pill">{{ $application->status }}</span>
                        </div>
                    @empty
                        <div class="text-secondary-custom small">No recent applications yet.</div>
                    @endforelse
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