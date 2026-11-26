<section class="settings-section" aria-labelledby="update-password-title">
    <header class="settings-section__header">
        <div class="settings-section__icon settings-section__icon--security" aria-hidden="true">S</div>
        <div>
            <h2 id="update-password-title">Update password</h2>
            <p>Use a strong password to protect your account.</p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="settings-password-form">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="form-label">Current password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @error('current_password')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="form-label">New password</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            @error('password')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="form-label">Confirm new password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            @error('password_confirmation')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary-custom text-white">Update password</button>
    </form>
</section>
