@extends('layouts.dashboard')

@section('title', 'Interview Practice | CareerPilot AI')

@section('content')
<div class="card-soft p-4 mb-4">
    <h4 class="fw-bold mb-3">Start a mock interview</h4>
    <form method="POST" action="{{ route('interviews.store') }}" class="row g-3 align-items-end">
        @csrf
        <div class="col-md-4">
            <label class="form-label">Role</label>
            <input type="text" name="role" class="form-control" placeholder="Product Manager" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" placeholder="Behavioral" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Difficulty</label>
            <select name="difficulty" class="form-select">
                <option>Beginner</option>
                <option selected>Intermediate</option>
                <option>Advanced</option>
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary-custom text-white">Begin interview</button>
        </div>
    </form>
</div>

<div class="row g-4">
    @forelse($sessions as $session)
    <div class="col-lg-6">
        <div class="card-soft p-4 h-100">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold mb-1">{{ $session->role }}</h5>
                    <div class="small text-secondary-custom">{{ $session->category }} • {{ $session->difficulty }}</div>
                </div>
                <span class="badge bg-soft-blue text-primary-custom">{{ $session->total_score ?? 0 }}%</span>
            </div>
            <div class="text-secondary-custom small mb-3">{{ $session->questions->count() }} questions</div>
            <a href="{{ route('interviews.show', $session->id) }}" class="btn btn-outline-custom">Open session</a>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card-soft p-5 text-center">
            <p class="text-secondary-custom mb-0">No interview sessions yet. Start a one to begin practice.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection