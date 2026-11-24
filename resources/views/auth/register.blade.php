<x-guest-layout>
    <div class="auth-header">
        <div class="eyebrow">Create account</div>
        <h1>Start your career growth plan</h1>
        <p>Build your profile, track applications, and prepare for interviews with AI-powered insights.</p>
    </div>

    @if ($errors->any())
    <div class="auth-alert auth-alert--error" role="alert" aria-live="assertive">
        <svg class="auth-alert__icon" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm0 5a1 1 0 0 1 1 1v5a1 1 0 1 1-2 0V8a1 1 0 0 1 1-1Zm0 10a1.25 1.25 0 1 1 0-2.5A1.25 1.25 0 0 1 12 17Z" />
        </svg>
        <span>Please review the highlighted fields and try again.</span>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="name" class="auth-label">Full name</label>
            <input id="name" class="auth-input @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" @error('name') aria-describedby="name-error" @enderror required autofocus autocomplete="name">
            @error('name')
            <span class="auth-field-error" id="name-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="email" class="auth-label">Email address</label>
            <input id="email" class="auth-input @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" @error('email') aria-describedby="email-error" @enderror required autocomplete="username">
            @error('email')
            <span class="auth-field-error" id="email-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password" class="auth-label">Password</label>
            <div class="password-wrap">
                <input id="password" class="auth-input @error('password') is-invalid @enderror" type="password" name="password" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" @error('password') aria-describedby="password-error" @enderror required autocomplete="new-password">
                <button type="button" class="pass-toggle" data-password-toggle data-target="password">Show</button>
            </div>
            @error('password')
            <span class="auth-field-error" id="password-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password_confirmation" class="auth-label">Confirm password</label>
            <div class="password-wrap">
                <input id="password_confirmation" class="auth-input @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" aria-invalid="{{ $errors->has('password_confirmation') ? 'true' : 'false' }}" @error('password_confirmation') aria-describedby="password_confirmation-error" @enderror required autocomplete="new-password">
                <button type="button" class="pass-toggle" data-password-toggle data-target="password_confirmation">Show</button>
            </div>
            @error('password_confirmation')
            <span class="auth-field-error" id="password_confirmation-error">{{ $message }}</span>
            @enderror
        </div>

        <label for="terms" class="auth-check auth-terms">
            <input id="terms" name="terms" type="checkbox" value="1" @checked(old('terms')) required>
            <span>I agree to the <a href="{{ route('terms-and-conditions') }}" class="auth-link">terms and conditions</a></span>
        </label>
        @error('terms')
        <span class="auth-field-error auth-error" id="terms-error">{{ $message }}</span>
        @enderror

        <button type="submit" class="auth-submit">Create account</button>

        <div class="auth-divider">or</div>

        <a href="{{ route('auth.google') }}" class="btn-google" aria-label="Continue with Google">
            <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path fill="#EA4335" d="M12 10.2v3.9h5.4c-.2 1.3-1.6 3.9-5.4 3.9-3.3 0-5.9-2.7-5.9-6s2.6-6 5.9-6c1.9 0 3.2.8 3.9 1.5l2.6-2.6C16.7 3.5 14.6 2.7 12 2.7 6.8 2.7 2.7 6.8 2.7 12s4.1 9.3 9.3 9.3c5.4 0 9-3.8 9-9.1 0-.6-.1-1.3-.2-1.9H12z" />
                <path fill="#34A853" d="M3.7 7.4l3.4 2.5c.9-1.8 2.9-3.1 4.9-3.1 1.9 0 3.2.8 3.9 1.5l2.6-2.6C16.7 3.5 14.6 2.7 12 2.7c-3.9 0-7.2 2.3-8.3 5.7z" />
                <path fill="#FBBC05" d="M3.7 16.6c1.1 3.4 4.4 5.7 8.3 5.7 2.5 0 4.6-.8 6.1-2.2l-3-2.6c-.8.5-1.8.9-3.1.9-2.8 0-5.2-1.9-6.1-4.5l-2.2 1.7z" />
                <path fill="#4285F4" d="M12 21.3c2.6 0 4.7-.9 6.3-2.4l-2.9-2.5c-.8.6-1.9 1-3.4 1-2.9 0-5.3-2.1-5.9-4.9L.9 11.8C1.9 17 6.4 21.3 12 21.3z" />
            </svg>
            Continue with Google
        </a>

        <div class="auth-footer">
            Already have an account? <a href="{{ route('login') }}" class="auth-link">Log in</a>
        </div>
    </form>
</x-guest-layout>