<section>
    <header class="mb-4">
        <h2 class="fw-bold mb-2">Update password</h2>
        <p class="text-secondary-custom mb-0">Use a strong password to keep your CareerPilot account protected.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="row g-3">
        @csrf
        @method('put')

        <div class="col-12">
            <label for="update_password_current_password" class="form-label fw-semibold">Current password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @error('current_password')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="update_password_password" class="form-label fw-semibold">New password</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            @error('password')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="update_password_password_confirmation" class="form-label fw-semibold">Confirm password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            @error('password_confirmation')
            <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 d-flex align-items-center gap-3 mt-2">
            <button type="submit" class="btn btn-primary-custom text-white">Save password</button>
        </div>
    </form>
</section>