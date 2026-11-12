@extends('layouts.dashboard')

@section('title', 'My Resumes | CareerPilot AI')

@section('content')
<div class="card-soft p-4 mb-4">
    <h4 class="fw-bold mb-3">Upload resume</h4>
    <form method="POST" action="{{ route('resumes.store') }}" enctype="multipart/form-data" class="row g-3 align-items-end">
        @csrf
        <div class="col-md-4">
            <label class="form-label">Resume title</label>
            <input type="text" name="title" class="form-control" placeholder="e.g. Product Analyst Resume" required>
        </div>
        <div class="col-md-5">
            <label class="form-label">Upload file</label>
            <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.txt" required>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary-custom text-white w-100">Upload</button>
        </div>
    </form>
</div>

<div class="row g-4">
    @forelse($resumes as $resume)
        <div class="col-lg-6">
            <div class="card-soft p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $resume->title }}</h5>
                        <div class="text-secondary-custom small">{{ $resume->original_name }}</div>
                    </div>
                    @if($resume->is_primary)
                        <span class="badge bg-success text-white">Primary</span>
                    @endif
                </div>
                <div class="small text-secondary-custom mb-3">
                    {{ number_format($resume->size / 1024, 1) }} KB • {{ $resume->mime_type ?? 'document' }}
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('resumes.download', $resume->id) }}" class="btn btn-sm btn-outline-custom">Download</a>
                    @if(!$resume->is_primary)
                        <form method="POST" action="{{ route('resumes.primary', $resume->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-custom">Set primary</button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('resumes.destroy', $resume->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card-soft p-5 text-center">
                <p class="text-secondary-custom mb-0">No resumes uploaded yet. Add your first resume to begin AI analysis.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
