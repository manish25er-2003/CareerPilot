@extends('layouts.public')

@section('title', 'CareerPilot AI | Your AI-Powered Career Growth Partner')

@section('content')
<section class="public-home-hero py-5 py-lg-6 bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="hero-badge badge rounded-pill px-3 py-2 fw-semibold">Career growth, reimagined</span>
                <h1 class="hero-title mt-3">Your AI-Powered Career Growth Partner</h1>
                <p class="lead text-secondary-custom mt-4 mb-4">Analyse your resume, improve your skills, practise interviews, and manage your job applications — all in one platform.</p>

                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="{{ route('register') }}" class="btn btn-primary-custom text-white px-4 py-3">Get Started</a>
                    <a href="{{ route('features') }}" class="btn btn-outline-custom px-4 py-3">Explore Features</a>
                </div>

                <div class="hero-metrics d-flex flex-wrap align-items-center gap-3 text-secondary-custom small">
                    <span class="hero-metric-pill">10k+ job seekers</span>
                    <span class="hero-metric-pill">4.9/5 rating</span>
                    <span class="hero-metric-pill">AI guided</span>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-panel card-soft p-4 p-xl-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <div class="small text-secondary-custom">Career dashboard</div>
                            <strong class="fs-5">Application pipeline</strong>
                        </div>
                        <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">+24% this month</span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-4">
                            <div class="stat-card h-100">
                                <div class="small text-secondary-custom">Resumes</div>
                                <div class="fs-4 fw-bold">08</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-card h-100">
                                <div class="small text-secondary-custom">Applications</div>
                                <div class="fs-4 fw-bold">42</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-card h-100">
                                <div class="small text-secondary-custom">Interviews</div>
                                <div class="fs-4 fw-bold">06</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-soft-blue rounded-4 p-3 mb-3">
                        <div class="d-flex justify-content-between small text-secondary-custom mb-2">
                            <span>Resume Match Score</span>
                            <span class="fw-bold text-primary-custom">92%</span>
                        </div>
                        <div class="progress" style="height: 12px;">
                            <div class="progress-bar bg-primary-custom" style="width: 92%"></div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <div class="border rounded-4 p-3 hero-job-row">
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div>
                                        <div class="fw-semibold">Senior Product Analyst</div>
                                        <div class="small text-secondary-custom">Northwind Labs</div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill px-2 py-1">Shortlisted</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border rounded-4 p-3 hero-job-row">
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div>
                                        <div class="fw-semibold">Frontend Engineer</div>
                                        <div class="small text-secondary-custom">BrightWave</div>
                                    </div>
                                    <span class="badge bg-warning text-dark rounded-pill px-2 py-1">Interviewing</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="public-feature-band py-5 bg-soft-blue">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Everything you need to land your next role</h2>
            <p class="text-secondary-custom mx-auto" style="max-width: 700px;">CareerPilot AI unifies your resume strategy, skill growth, interview prep, and application tracking in one clear workflow.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card-soft feature-card p-4 h-100">
                    <div class="feature-icon">AI</div>
                    <h5 class="fw-bold">AI Resume Analysis</h5>
                    <p class="text-secondary-custom mb-0">Get match scores, ATS suggestions, skills gaps, and action items to improve every resume version.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card-soft feature-card p-4 h-100">
                    <div class="feature-icon">SK</div>
                    <h5 class="fw-bold">Skill Tracking</h5>
                    <p class="text-secondary-custom mb-0">Organize your strengths by category and monitor growth with live professional profile progress.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card-soft feature-card p-4 h-100">
                    <div class="feature-icon">IP</div>
                    <h5 class="fw-bold">Interview Practice</h5>
                    <p class="text-secondary-custom mb-0">Generate mock questions, capture answers, and receive scored feedback to sharpen your delivery.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="public-steps py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">How it works</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-soft process-card p-4 text-center h-100">
                    <div class="display-6 mb-3">1</div>
                    <h5 class="fw-bold">Upload & Profile</h5>
                    <p class="text-secondary-custom mb-0">Create a strong career profile and upload your best resume versions.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-soft process-card p-4 text-center h-100">
                    <div class="display-6 mb-3">2</div>
                    <h5 class="fw-bold">Analyse & Improve</h5>
                    <p class="text-secondary-custom mb-0">Review AI recommendations, missing skills, and impact-driven resume upgrades.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-soft process-card p-4 text-center h-100">
                    <div class="display-6 mb-3">3</div>
                    <h5 class="fw-bold">Apply & Practice</h5>
                    <p class="text-secondary-custom mb-0">Track applications and rehearse interviews to stay ready for every opportunity.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="public-why py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Why professionals choose CareerPilot AI</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card-soft feature-card p-4 h-100">
                    <h5 class="fw-bold">Built for career momentum</h5>
                    <ul class="list-unstyled mb-0 text-secondary-custom mt-3">
                        <li class="mb-2">• AI suggestions based on your job target</li>
                        <li class="mb-2">• Interview readiness and role-specific prep</li>
                        <li class="mb-2">• Job pipeline tracking with statuses and notes</li>
                        <li class="mb-2">• Clean dashboards built for daily execution</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-soft feature-card p-4 h-100">
                    <h5 class="fw-bold">Career clarity</h5>
                    <ul class="list-unstyled mb-0 text-secondary-custom mt-3">
                        <li class="mb-2">• Identify skill gaps before interviews</li>
                        <li class="mb-2">• Improve resume story and job fit</li>
                        <li class="mb-2">• Keep track of opportunities and progress</li>
                        <li class="mb-2">• Keep your profile strong and recruiter-ready</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="public-testimonials py-5 bg-soft-blue">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">What job seekers say</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-soft testimonial-card p-4 h-100">
                    <p class="text-secondary-custom">“CareerPilot helped me turn my resume into a role-specific story and gave me the confidence to succeed in interviews.”</p>
                    <div class="fw-semibold">Aisha M.</div>
                    <div class="small text-secondary-custom">Product Analyst</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-soft testimonial-card p-4 h-100">
                    <p class="text-secondary-custom">“The AI resume analysis identified gaps I would have missed. I started applying with much more clarity.”</p>
                    <div class="fw-semibold">Daniel K.</div>
                    <div class="small text-secondary-custom">Software Engineer</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-soft testimonial-card p-4 h-100">
                    <p class="text-secondary-custom">“The dashboard keeps my applications organized, and the mock interviews feel realistic and useful.”</p>
                    <div class="fw-semibold">Nina R.</div>
                    <div class="small text-secondary-custom">UX Designer</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="public-cta py-5">
    <div class="container">
        <div class="cta-panel text-center">
            <h2 class="section-title mb-3">Ready to accelerate your career?</h2>
            <p class="text-secondary-custom mb-4">Join the platform built to help you move from job search chaos to focused execution.</p>
            <a href="{{ route('register') }}" class="btn btn-primary-custom text-white px-4 py-3">Start Your Career Growth Plan</a>
        </div>
    </div>
</section>
@endsection
