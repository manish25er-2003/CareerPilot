<section>
    <header class="mb-4">
        <h2 class="fw-bold mb-2">Profile information</h2>
        <p class="text-secondary-custom mb-0">Update your details and keep your account information accurate.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="row g-3 mt-2">
        @csrf
        @method('patch')

        <div class="col-12">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 rounded-4 border" style="background: rgba(124,77,255,0.04);">
                    <p class="mb-2 fw-medium text-dark">Your email address is unverified.</p>
                    <button form="send-verification" class="btn btn-sm btn-outline-custom">Resend verification email</button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 mb-0 text-success small">A new verification link has been sent to your email address.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="col-12 d-flex flex-wrap align-items-center gap-3 mt-3">
            <button type="submit" class="btn btn-primary-custom text-white">Save changes</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small fw-semibold">Saved.</span>
            @endif
        </div>
    </form>
</section>
