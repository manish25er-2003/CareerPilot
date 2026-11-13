<x-guest-layout>
    <div class="auth-header">
        <div class="eyebrow">Secure action</div>
        <h1>Confirm your password</h1>
        <p>Please enter your password to continue to this secure area.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="auth-form">
        @csrf

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

        <button type="submit" class="auth-submit">Confirm</button>
    </form>
</x-guest-layout>