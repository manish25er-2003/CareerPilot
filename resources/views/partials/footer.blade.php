@php
    $quickLinks = [
        ['label' => 'Home', 'route' => route('home')],
    ];

    if (auth()->check()) {
        $quickLinks = [
            ['label' => 'Home', 'route' => route('home')],
            ['label' => 'Dashboard', 'route' => route('dashboard')],
            ['label' => 'My Profile', 'route' => route('profile.index')],
            ['label' => 'Job Applications', 'route' => route('jobs.index')],
            ['label' => 'My Resumes', 'route' => route('resumes.index')],
            ['label' => 'Interview Practice', 'route' => route('interviews.index')],
        ];
    }
@endphp

<footer class="premium-footer">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="brand-dot"></span>
                    <span class="fw-bold text-white">CareerPilot AI</span>
                </div>
                <p class="footer-copy mb-3">
                    Your smarter companion for career growth, resume building and interview preparation.
                </p>
                <p class="footer-meta mb-0">© {{ date('Y') }} CareerPilot AI</p>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="footer-title">Quick Links</h6>
                <div class="footer-links d-grid gap-2">
                    @foreach($quickLinks as $link)
                        <a href="{{ $link['route'] }}" class="footer-link text-decoration-none">{{ $link['label'] }}</a>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <h6 class="footer-title">Connect</h6>
                <div class="footer-links d-grid gap-2 mb-3">
                    <a href="{{ route('contact') }}" class="footer-link text-decoration-none">Contact</a>
                    <a href="{{ route('contact') }}" class="footer-link text-decoration-none">Help &amp; Support</a>
                    <a href="{{ route('privacy-policy') }}" class="footer-link text-decoration-none">Privacy Policy</a>
                    <a href="{{ route('terms-and-conditions') }}" class="footer-link text-decoration-none">Terms &amp; Conditions</a>
                </div>

                <a href="{{ route('developer') }}" class="btn btn-primary-custom text-white footer-developer-btn">
                    <span aria-hidden="true">⌨️</span>
                    Meet the Developer
                </a>
            </div>
        </div>
    </div>
</footer>
