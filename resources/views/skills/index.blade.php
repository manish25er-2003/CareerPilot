@extends('layouts.dashboard')

@section('title', 'My Skills | CareerPilot AI')

@section('content')
<div class="card-soft p-4 mb-4">
    <h4 class="fw-bold mb-3">Skill profile</h4>
    <form method="POST" action="{{ route('skills.store') }}" class="row g-3 align-items-end">
        @csrf
        <div class="col-md-3">
            <label class="form-label">Skill</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Proficiency</label>
            <select name="proficiency_level" class="form-select">
                <option>Beginner</option>
                <option>Intermediate</option>
                <option>Advanced</option>
                <option>Expert</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary-custom text-white w-100">Add skill</button>
        </div>
        <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2"></textarea>
        </div>
    </form>
</div>

<div class="row g-4">
    @forelse($skills as $skill)
    <div class="col-md-6 col-xl-4">
        <div class="card-soft p-4 h-100">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <h5 class="fw-bold mb-1">{{ $skill->name }}</h5>
                    <div class="text-secondary-custom small">{{ $skill->category }}</div>
                </div>
                <span class="badge bg-soft-blue text-primary-custom">{{ $skill->pivot->proficiency_level ?? 'Beginner' }}</span>
            </div>
            <p class="text-secondary-custom small mb-3">{{ $skill->description ?? 'No description added yet.' }}</p>
            <form method="POST" action="{{ route('skills.update', $skill->id) }}" class="row g-2 align-items-end">
                @csrf
                @method('PUT')
                <div class="col-8">
                    <select name="proficiency_level" class="form-select form-select-sm">
                        @foreach(['Beginner','Intermediate','Advanced','Expert'] as $level)
                        <option value="{{ $level }}" {{ ($skill->pivot->proficiency_level ?? 'Beginner') === $level ? 'selected' : '' }}>{{ $level }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <button class="btn btn-sm btn-outline-custom w-100" type="submit">Save</button>
                </div>
            </form>
            <form method="POST" action="{{ route('skills.destroy', $skill->id) }}" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger w-100">Remove</button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card-soft p-5 text-center">
            <p class="text-secondary-custom mb-0">No skills added yet. Start by adding your core strengths.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection