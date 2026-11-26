<section class="settings-section" aria-labelledby="delete-account-title">
    <header class="settings-section__header settings-section__header--danger">
        <div class="settings-section__icon settings-section__icon--danger" aria-hidden="true">!</div>
        <div>
            <h2 id="delete-account-title">Delete account</h2>
            <p>This permanently removes your account and its data.</p>
        </div>
    </header>

    <button type="button" class="btn btn-outline-danger settings-delete-button" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
        Delete my account
    </button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-4 p-lg-5">
                    @csrf
                    @method('delete')
                    <h2 id="confirm-user-deletion-title" class="fw-bold mb-3">Are you sure?</h2>
                    <p class="text-secondary-custom mb-4">This action is permanent and cannot be undone. Please enter your password to confirm.</p>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                        @error('password')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>