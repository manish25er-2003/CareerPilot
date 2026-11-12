<x-guest-layout>
    <div class="auth-header">
        <div class="eyebrow">Reset password</div>
        <h1>Forgot your password?</h1>
        <p>Enter your email and we’ll send a secure reset link to continue.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="email" class="auth-label">Email address</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="auth-submit">Email reset link</button>

        <div class="auth-footer">
            <a href="{{ route('login') }}" class="auth-link">Back to sign in</a>
        </div>
    </form>
</x-guest-layout>
