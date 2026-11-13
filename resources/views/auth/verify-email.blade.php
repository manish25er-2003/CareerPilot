<x-guest-layout>
    <div class="auth-header">
        <div class="eyebrow">Verify email</div>
        <h1>Check your inbox</h1>
        <p>We’ve sent a verification link to your email address to activate your account.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="alert alert-success mb-4">
        A new verification link has been sent to the email address provided during registration.
    </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="auth-form">
        @csrf
        <button type="submit" class="auth-submit">Resend verification email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf
        <button type="submit" class="btn-google" style="width: 100%;">Log out</button>
    </form>
</x-guest-layout>