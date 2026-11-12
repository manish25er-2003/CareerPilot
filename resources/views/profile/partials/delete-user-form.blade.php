<section>
    <header class="mb-4">
        <h2 class="fw-bold mb-2 text-danger">Delete account</h2>
        <p class="text-secondary-custom mb-0">Once your account is deleted, all of its resources and data will be permanently removed. Please review before proceeding.</p>
    </header>

    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
        Delete account
    </button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-4 p-lg-5">
                    @csrf
                    @method('delete')
                    <h2 class="fw-bold mb-3">Are you sure?</h2>
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
