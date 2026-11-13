<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="auth-header">
        <div class="eyebrow">Welcome back</div>
        <h1>Sign in to your account</h1>
        <p>Manage your resume, jobs, interviews and growth in one place.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="email" class="auth-label">Email address</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password" class="auth-label">Password</label>
            <div class="password-wrap">
                <input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password">
                <button type="button" class="pass-toggle" data-password-toggle data-target="password">Show</button>
            </div>
            @error('password')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-row">
            <label for="remember_me" class="auth-check">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="auth-link">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="auth-submit">Log in</button>

        <div class="auth-divider">or</div>

        <button type="button" class="btn-google" aria-label="Continue with Google">
            <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path fill="#EA4335" d="M12 10.2v3.9h5.4c-.2 1.3-1.6 3.9-5.4 3.9-3.3 0-5.9-2.7-5.9-6s2.6-6 5.9-6c1.9 0 3.2.8 3.9 1.5l2.6-2.6C16.7 3.5 14.6 2.7 12 2.7 6.8 2.7 2.7 6.8 2.7 12s4.1 9.3 9.3 9.3c5.4 0 9-3.8 9-9.1 0-.6-.1-1.3-.2-1.9H12z" />
                <path fill="#34A853" d="M3.7 7.4l3.4 2.5c.9-1.8 2.9-3.1 4.9-3.1 1.9 0 3.2.8 3.9 1.5l2.6-2.6C16.7 3.5 14.6 2.7 12 2.7c-3.9 0-7.2 2.3-8.3 5.7z" />
                <path fill="#FBBC05" d="M3.7 16.6c1.1 3.4 4.4 5.7 8.3 5.7 2.5 0 4.6-.8 6.1-2.2l-3-2.6c-.8.5-1.8.9-3.1.9-2.8 0-5.2-1.9-6.1-4.5l-2.2 1.7z" />
                <path fill="#4285F4" d="M12 21.3c2.6 0 4.7-.9 6.3-2.4l-2.9-2.5c-.8.6-1.9 1-3.4 1-2.9 0-5.3-2.1-5.9-4.9L.9 11.8C1.9 17 6.4 21.3 12 21.3z" />
            </svg>
            Continue with Google
        </button>

        <div class="auth-footer">
            Don’t have an account? <a href="{{ route('register') }}" class="auth-link">Create one</a>
        </div>
    </form>
</x-guest-layout>