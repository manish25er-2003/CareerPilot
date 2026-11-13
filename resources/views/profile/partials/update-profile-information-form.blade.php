<section>
    <header class="mb-4">
        <h2 class="fw-bold mb-2">Profile information</h2>
        <p class="text-secondary-custom mb-0">Keep your public career profile accurate and recruiter-ready.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="row g-3 mt-2">
        @csrf
        @method('patch')

        <div class="col-12">
            <label for="profile_image" class="form-label fw-semibold">Profile image</label>
            <input id="profile_image" name="profile_image" type="file" class="form-control" accept="image/png,image/jpeg,image/webp">
            <small class="text-secondary-custom d-block mt-1">PNG, JPG, or WEBP up to 2MB.</small>
        </div>

        <div class="col-md-6">
            <label for="name" class="form-label fw-semibold">Full name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="full_name" class="form-label fw-semibold">Professional name</label>
            <input id="full_name" name="full_name" type="text" class="form-control" value="{{ old('full_name', $user->profile?->full_name ?? '') }}" placeholder="Your full professional name">
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label fw-semibold">Phone</label>
            <input id="phone" name="phone" type="tel" class="form-control" value="{{ old('phone', $user->profile?->phone ?? '') }}" placeholder="+1 (555) 123-4567">
        </div>

        <div class="col-12">
            <label for="professional_headline" class="form-label fw-semibold">Professional headline</label>
            <input id="professional_headline" name="professional_headline" type="text" class="form-control" value="{{ old('professional_headline', $user->profile?->professional_headline ?? '') }}" placeholder="Product designer and career growth specialist">
        </div>

        <div class="col-md-6">
            <label for="location" class="form-label fw-semibold">Location</label>
            <input id="location" name="location" type="text" class="form-control" value="{{ old('location', $user->profile?->location ?? '') }}" placeholder="New York, NY">
        </div>

        <div class="col-md-6">
            <label for="experience_years" class="form-label fw-semibold">Years of experience</label>
            <input id="experience_years" name="experience_years" type="number" min="0" max="60" class="form-control" value="{{ old('experience_years', $user->profile?->experience_years ?? 0) }}">
        </div>

        <div class="col-12">
            <label for="education" class="form-label fw-semibold">Education</label>
            <input id="education" name="education" type="text" class="form-control" value="{{ old('education', $user->profile?->education ?? '') }}" placeholder="B.Sc. Computer Science, University of London">
        </div>

        <div class="col-12">
            <label for="bio" class="form-label fw-semibold">About</label>
            <textarea id="bio" name="bio" rows="4" class="form-control" placeholder="Tell recruiters about your background and strengths.">{{ old('bio', $user->profile?->bio ?? '') }}</textarea>
        </div>

        <div class="col-md-4">
            <label for="linkedin_url" class="form-label fw-semibold">LinkedIn</label>
            <input id="linkedin_url" name="linkedin_url" type="url" class="form-control" value="{{ old('linkedin_url', $user->profile?->linkedin_url ?? '') }}" placeholder="https://linkedin.com/in/yourprofile">
        </div>

        <div class="col-md-4">
            <label for="github_url" class="form-label fw-semibold">GitHub</label>
            <input id="github_url" name="github_url" type="url" class="form-control" value="{{ old('github_url', $user->profile?->github_url ?? '') }}" placeholder="https://github.com/yourname">
        </div>

        <div class="col-md-4">
            <label for="portfolio_url" class="form-label fw-semibold">Portfolio</label>
            <input id="portfolio_url" name="portfolio_url" type="url" class="form-control" value="{{ old('portfolio_url', $user->profile?->portfolio_url ?? '') }}" placeholder="https://yourportfolio.com">
        </div>

        <div class="col-12 d-flex flex-wrap align-items-center gap-3 mt-3">
            <button type="submit" class="btn btn-primary-custom text-white">Save changes</button>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <button form="send-verification" class="btn btn-outline-custom">Verify email</button>
            @endif

            @if (session('status') === 'profile-updated')
            <span class="text-success small fw-semibold">Saved.</span>
            @endif
        </div>
    </form>
</section>