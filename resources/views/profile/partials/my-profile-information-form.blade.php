<section class="my-profile-information" aria-labelledby="personal-information-title">
    <header class="my-profile-information__heading">
        <span class="my-profile-information__heading-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.8" />
                <path d="M5 20v-1.5a7 7 0 0 1 14 0V20H5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
            </svg>
        </span>
        <div>
            <h2 id="personal-information-title">Personal Information</h2>
            <p>Keep your account and contact details up to date.</p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="my-profile-form">
        @csrf
        @method('patch')

        <div class="my-profile-personal-grid">
            <div class="my-profile-avatar-field">
                <span class="my-profile-field__label">Profile Image</span>
                <div class="my-profile-avatar my-profile-avatar--editable">
                    @if ($profileImage)
                    <img src="{{ $profileImage }}" alt="{{ $displayName }}">
                    @else
                    {{ $initials ?: 'U' }}
                    @endif
                    <label for="profile_image" class="my-profile-avatar__upload" aria-label="Change profile image" title="Change profile image">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M4 8.5A1.5 1.5 0 0 1 5.5 7H8l1.5-2h5L16 7h2.5A1.5 1.5 0 0 1 20 8.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 17.5v-9Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                            <circle cx="12" cy="12.5" r="3.2" stroke="currentColor" stroke-width="1.7" />
                        </svg>
                    </label>
                </div>
                <input id="profile_image" name="profile_image" type="file" class="visually-hidden" accept="image/png,image/jpeg,image/webp" aria-describedby="profile-image-help">
                <small id="profile-image-help" class="my-profile-help">PNG, JPG, or WEBP up to 2 MB.</small>
                @error('profile_image')
                <div class="my-profile-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="my-profile-field">
                <label for="name" class="my-profile-field__label">Full Name <span>*</span></label>
                <div class="my-profile-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="12" cy="8" r="3.3" stroke="currentColor" stroke-width="1.7" />
                        <path d="M5.5 20v-1.3a6.5 6.5 0 0 1 13 0V20h-13Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                    </svg>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" autocomplete="name" required aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}">
                </div>
                @error('name')
                <div class="my-profile-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="my-profile-field">
                <label for="email" class="my-profile-field__label">Email <span>*</span></label>
                <div class="my-profile-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="3.5" y="5.5" width="17" height="13" rx="2" stroke="currentColor" stroke-width="1.7" />
                        <path d="m5 7 7 5.5L19 7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" autocomplete="username" required aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                </div>
                @error('email')
                <div class="my-profile-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="my-profile-field">
                <label for="phone" class="my-profile-field__label">Phone</label>
                <div class="my-profile-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 3.5h3l1.5 4-2 1.5a14 14 0 0 0 5.5 5.5l1.5-2 4 1.5v3a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 5 6a2 2 0 0 1 2-2.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                    </svg>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone', $profile->phone ?? '') }}" placeholder="+1 (555) 123-4567" autocomplete="tel" aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}">
                </div>
                @error('phone')
                <div class="my-profile-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="my-profile-field">
                <label for="location" class="my-profile-field__label">Location</label>
                <div class="my-profile-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M19 10.2c0 5-7 10.3-7 10.3S5 15.2 5 10.2a7 7 0 1 1 14 0Z" stroke="currentColor" stroke-width="1.7" />
                        <circle cx="12" cy="10" r="2.2" stroke="currentColor" stroke-width="1.7" />
                    </svg>
                    <input id="location" name="location" type="text" value="{{ old('location', $profile->location ?? '') }}" placeholder="City, country" autocomplete="address-level2" aria-invalid="{{ $errors->has('location') ? 'true' : 'false' }}">
                </div>
                @error('location')
                <div class="my-profile-field-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <section class="my-profile-form-section" aria-labelledby="professional-details-title">
            <header class="my-profile-form-section__heading">
                <span aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <rect x="3.5" y="7" width="17" height="13" rx="2" stroke="currentColor" stroke-width="1.8" />
                        <path d="M8 7V5.5A1.5 1.5 0 0 1 9.5 4h5A1.5 1.5 0 0 1 16 5.5V7m-4 5v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </span>
                <div>
                    <h3 id="professional-details-title">Professional Details</h3>
                </div>
            </header>
            <div class="my-profile-fields-grid my-profile-fields-grid--professional">
                <div class="my-profile-field">
                    <label for="full_name" class="my-profile-field__label">Professional Name</label>
                    <div class="my-profile-control">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="12" cy="8" r="3.3" stroke="currentColor" stroke-width="1.7" />
                            <path d="M5.5 20v-1.3a6.5 6.5 0 0 1 13 0V20h-13Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                        </svg>
                        <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $profile->full_name ?? '') }}" placeholder="Your professional name" aria-invalid="{{ $errors->has('full_name') ? 'true' : 'false' }}">
                    </div>
                    @error('full_name')
                    <div class="my-profile-field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-profile-field">
                    <label for="experience_years" class="my-profile-field__label">Years of Experience</label>
                    <div class="my-profile-control">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M4 19v-5m5 5V9m5 10V5m5 14v-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <input id="experience_years" name="experience_years" type="number" min="0" max="60" value="{{ old('experience_years', $profile->experience_years ?? 0) }}" aria-invalid="{{ $errors->has('experience_years') ? 'true' : 'false' }}">
                    </div>
                    @error('experience_years')
                    <div class="my-profile-field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-profile-field my-profile-field--full">
                    <label for="professional_headline" class="my-profile-field__label">Professional Headline</label>
                    <div class="my-profile-control">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v11a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 17.5v-11Z" stroke="currentColor" stroke-width="1.7" />
                            <path d="M8 9h8m-8 4h8m-8 4h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                        </svg>
                        <input id="professional_headline" name="professional_headline" type="text" value="{{ old('professional_headline', $profile->professional_headline ?? '') }}" placeholder="Your role or career focus" aria-invalid="{{ $errors->has('professional_headline') ? 'true' : 'false' }}">
                    </div>
                    @error('professional_headline')
                    <div class="my-profile-field-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </section>

        <section class="my-profile-form-section" aria-labelledby="education-about-title">
            <header class="my-profile-form-section__heading">
                <span aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5M3 16.5l9 4.5 9-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <div>
                    <h3 id="education-about-title">Education &amp; About</h3>
                </div>
            </header>
            <div class="my-profile-fields-grid">
                <div class="my-profile-field">
                    <label for="education" class="my-profile-field__label">Education</label>
                    <div class="my-profile-control">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="m3 9 9-5 9 5-9 5-9-5Zm4 2.2v4.3c3 2.6 7 2.6 10 0v-4.3M21 9v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <input id="education" name="education" type="text" value="{{ old('education', $profile->education ?? '') }}" placeholder="Degree or qualification" aria-invalid="{{ $errors->has('education') ? 'true' : 'false' }}">
                    </div>
                    @error('education')
                    <div class="my-profile-field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-profile-field">
                    <label for="bio" class="my-profile-field__label">About</label>
                    <div class="my-profile-control my-profile-control--textarea">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.7" />
                            <path d="M12 11v5m0-8h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <textarea id="bio" name="bio" rows="2" placeholder="A short introduction for your career profile." aria-invalid="{{ $errors->has('bio') ? 'true' : 'false' }}">{{ old('bio', $profile->bio ?? '') }}</textarea>
                    </div>
                    @error('bio')
                    <div class="my-profile-field-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </section>

        <section class="my-profile-form-section" aria-labelledby="online-profiles-title">
            <header class="my-profile-form-section__heading">
                <span aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="m10 13.5 4-4m-6.2 7.7-1.6 1.6a3 3 0 0 1-4.2-4.2l4.4-4.4a3 3 0 0 1 4.2 0m5.4 0 1.6-1.6a3 3 0 0 1 4.2 4.2l-4.4 4.4a3 3 0 0 1-4.2 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </span>
                <div>
                    <h3 id="online-profiles-title">Online Profiles</h3>
                </div>
            </header>
            <div class="my-profile-fields-grid my-profile-fields-grid--links">
                <div class="my-profile-field">
                    <label for="linkedin_url" class="my-profile-field__label">LinkedIn</label>
                    <div class="my-profile-control">
                        <span class="my-profile-control__brand" aria-hidden="true">in</span>
                        <input id="linkedin_url" name="linkedin_url" type="url" value="{{ old('linkedin_url', $profile->linkedin_url ?? '') }}" placeholder="https://linkedin.com/in/..." aria-invalid="{{ $errors->has('linkedin_url') ? 'true' : 'false' }}">
                    </div>
                    @error('linkedin_url')
                    <div class="my-profile-field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-profile-field">
                    <label for="github_url" class="my-profile-field__label">GitHub</label>
                    <div class="my-profile-control">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2.7a9.3 9.3 0 0 0-2.9 18.1c.5.1.6-.2.6-.5v-1.7c-2.4.5-2.9-1-2.9-1-.4-1-.9-1.2-.9-1.2-.8-.5.1-.5.1-.5.9.1 1.4.9 1.4.9.8 1.4 2.1 1 2.7.7.1-.6.3-1 .6-1.3-1.9-.2-3.8-.9-3.8-4.2 0-.9.3-1.6.9-2.2-.1-.2-.4-1.1.1-2.2 0 0 .7-.2 2.3.8a8 8 0 0 1 4.2 0c1.6-1 2.3-.8 2.3-.8.5 1.1.2 2 .1 2.2.6.6.9 1.3.9 2.2 0 3.3-1.9 4-3.8 4.2.3.3.6.8.6 1.6v2.4c0 .3.1.6.6.5A9.3 9.3 0 0 0 12 2.7Z" />
                        </svg>
                        <input id="github_url" name="github_url" type="url" value="{{ old('github_url', $profile->github_url ?? '') }}" placeholder="https://github.com/..." aria-invalid="{{ $errors->has('github_url') ? 'true' : 'false' }}">
                    </div>
                    @error('github_url')
                    <div class="my-profile-field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-profile-field">
                    <label for="portfolio_url" class="my-profile-field__label">Portfolio</label>
                    <div class="my-profile-control">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="m10 13.5 4-4m-6.2 7.7-1.6 1.6a3 3 0 0 1-4.2-4.2l4.4-4.4a3 3 0 0 1 4.2 0m5.4 0 1.6-1.6a3 3 0 0 1 4.2 4.2l-4.4 4.4a3 3 0 0 1-4.2 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                        <input id="portfolio_url" name="portfolio_url" type="url" value="{{ old('portfolio_url', $profile->portfolio_url ?? '') }}" placeholder="https://your-site.com" aria-invalid="{{ $errors->has('portfolio_url') ? 'true' : 'false' }}">
                    </div>
                    @error('portfolio_url')
                    <div class="my-profile-field-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </section>

        <footer class="my-profile-form__actions">
            <button type="submit" class="my-profile-button my-profile-button--primary">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 4h12l3 3v13H4V4h1Zm3 0v5h8V4m-8 16v-7h8v7" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                </svg>
                Save Changes
            </button>
            <button type="reset" class="my-profile-button my-profile-button--outline">Cancel</button>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <button form="send-verification" class="my-profile-button my-profile-button--outline">Verify Email</button>
            @endif
        </footer>
    </form>
</section>
