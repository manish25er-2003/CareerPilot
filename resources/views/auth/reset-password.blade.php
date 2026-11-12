<x-guest-layout>
    <div class="auth-header">
        <div class="eyebrow">New password</div>
        <h1>Create a new password</h1>
        <p>Choose a strong password to keep your account secure.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field">
            <label for="email" class="auth-label">Email address</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password" class="auth-label">Password</label>
            <div class="password-wrap">
                <input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password">
                <button type="button" class="pass-toggle" data-password-toggle data-target="password">Show</button>
            </div>
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password_confirmation" class="auth-label">Confirm password</label>
            <div class="password-wrap">
                <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password">
                <button type="button" class="pass-toggle" data-password-toggle data-target="password_confirmation">Show</button>
            </div>
        </div>

        <button type="submit" class="auth-submit">Reset password</button>
    </form>
</x-guest-layout>
