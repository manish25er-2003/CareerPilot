<section class="settings-section" aria-labelledby="profile-information-title">
    <header class="settings-section__header">
        <div class="settings-section__icon" aria-hidden="true">P</div>
        <div>
            <h2 id="profile-information-title">Profile information</h2>
            <p>Keep your account and career details up to date.</p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="settings-form row">
        @csrf
        @method('patch')

        <div class="col-md-4">
            <label for="profile_image" class="form-label">Profile image</label>
            <div class="settings-photo-field">
                <div class="settings-photo-avatar" aria-hidden="true">
                    @if ($profileImage)
                    <img src="{{ $profileImage }}" alt="">
                    @else
                    <span>{{ $initials ?: 'U' }}</span>
                    @endif
                </div>
                <input id="profile_image" name="profile_image" type="file" class="form-control settings-file-input" accept="image/png,image/jpeg,image/webp" aria-describedby="profile-image-help">
            </div>
            <small id="profile-image-help" class="settings-help">PNG, JPG, or WEBP up to 2MB.</small>
        </div>

        <div class="col-md-4">
            <label for="name" class="form-label">Full name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autocomplete="name">
            @error('name')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="full_name" class="form-label">Professional name</label>
            <input id="full_name" name="full_name" type="text" class="form-control" value="{{ old('full_name', $user->profile?->full_name ?? '') }}" placeholder="Your professional name">
        </div>

        <div class="col-md-4">
            <label for="phone" class="form-label">Phone</label>
            <input id="phone" name="phone" type="tel" class="form-control" value="{{ old('phone', $user->profile?->phone ?? '') }}" placeholder="+1 (555) 123-4567">
            @error('phone')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="location" class="form-label">Location</label>
            <input id="location" name="location" type="text" class="form-control" value="{{ old('location', $user->profile?->location ?? '') }}" placeholder="City, country">
        </div>

        <div class="col-md-8">
            <label for="professional_headline" class="form-label">Professional headline</label>
            <input id="professional_headline" name="professional_headline" type="text" class="form-control" value="{{ old('professional_headline', $user->profile?->professional_headline ?? '') }}" placeholder="Your role or career focus">
        </div>

        <div class="col-md-4">
            <label for="experience_years" class="form-label">Years of experience</label>
            <input id="experience_years" name="experience_years" type="number" min="0" max="60" class="form-control" value="{{ old('experience_years', $user->profile?->experience_years ?? 0) }}">
        </div>

        <div class="col-md-6">
            <label for="education" class="form-label">Education</label>
            <input id="education" name="education" type="text" class="form-control" value="{{ old('education', $user->profile?->education ?? '') }}" placeholder="Degree or qualification">
        </div>

        <div class="col-md-6">
            <label for="bio" class="form-label">About</label>
            <textarea id="bio" name="bio" rows="2" class="form-control" placeholder="A short introduction for your career profile.">{{ old('bio', $user->profile?->bio ?? '') }}</textarea>
        </div>

        <div class="col-md-4">
            <label for="linkedin_url" class="form-label">LinkedIn</label>
            <input id="linkedin_url" name="linkedin_url" type="url" class="form-control" value="{{ old('linkedin_url', $user->profile?->linkedin_url ?? '') }}" placeholder="https://linkedin.com/in/...">
        </div>

        <div class="col-md-4">
            <label for="github_url" class="form-label">GitHub</label>
            <input id="github_url" name="github_url" type="url" class="form-control" value="{{ old('github_url', $user->profile?->github_url ?? '') }}" placeholder="https://github.com/...">
        </div>

        <div class="col-md-4">
            <label for="portfolio_url" class="form-label">Portfolio</label>
            <input id="portfolio_url" name="portfolio_url" type="url" class="form-control" value="{{ old('portfolio_url', $user->profile?->portfolio_url ?? '') }}" placeholder="https://your-site.com">
        </div>

        <div class="col-12 settings-form__actions">
            <button type="submit" class="btn btn-primary-custom text-white">Save changes</button>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <button form="send-verification" class="btn btn-outline-custom">Verify email</button>
            @endif
        </div>
    </form>
</section>
