<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <div class="eyebrow">Account</div>
                <h2 class="fw-bold mb-0" style="font-size: clamp(2rem, 4vw, 2.4rem);">Profile settings</h2>
            </div>
        </div>
    </x-slot>

    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-xl-8">
                <div class="card-soft p-4 p-lg-5">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card-soft p-4 p-lg-5">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div class="col-12">
                <div class="card-soft p-4 p-lg-5 border-danger-subtle">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
