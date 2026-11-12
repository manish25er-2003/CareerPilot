@extends('layouts.public')

@section('title', 'Contact | CareerPilot AI')

@section('content')
<section class="py-5">
    <div class="container" style="max-width: 760px;">
        <div class="card-soft p-4 p-lg-5">
            <h1 class="section-title text-center">Contact us</h1>
            <p class="text-secondary-custom text-center mb-4">We’d love to hear from you. Send us a message and we’ll get back to you soon.</p>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Message</label>
                        <textarea name="message" rows="6" class="form-control" required>{{ old('message') }}</textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary-custom text-white px-4 py-3">Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
