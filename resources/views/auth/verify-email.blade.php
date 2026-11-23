<x-guest-layout>
    <div class="auth-header">
        <div class="eyebrow">Verify email</div>
        <h1>Check your inbox</h1>
        <p class="text-secondary-custom mb-4">Check your inbox for a verification link.</p>
    </div>

    <form method="POST" action="{{ route('verification.send') }}" class="auth-form">
        @csrf
        <button type="submit" class="auth-submit">Resend verification email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf
        <button type="submit" class="btn-google" style="width: 100%;">Log out</button>
    </form>
</x-guest-layout>