@extends('layouts.dashboard')

@section('title', 'Interview Session | CareerPilot AI')

@section('content')
<div class="card-soft p-4 mb-4">
    <h4 class="fw-bold mb-1">{{ $session->role }}</h4>
    <div class="text-secondary-custom">{{ $session->category }} • {{ $session->difficulty }} • Score: {{ $session->total_score ?? 0 }}%</div>
</div>

@foreach($session->questions as $question)
<div class="card-soft p-4 mb-4">
    <h5 class="fw-bold mb-3">Question {{ $loop->iteration }}</h5>
    <p class="mb-3">{{ $question->question_text }}</p>

    @if($question->answer)
    <div class="border rounded-3 p-3 bg-soft-blue mb-3">
        <div class="small text-secondary-custom mb-1">Your answer</div>
        <p class="mb-2">{{ $question->answer->answer_text }}</p>
        <div class="fw-semibold">Score: {{ $question->answer->score }}%</div>
        <div class="small text-secondary-custom mt-2">Feedback: {{ $question->answer->feedback }}</div>
    </div>
    @endif

    <form method="POST" action="{{ route('interviews.answer', $session->id) }}">
        @csrf
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        <textarea name="answer" rows="5" class="form-control" placeholder="Type your answer here..." required></textarea>
        <button type="submit" class="btn btn-primary-custom text-white mt-3">Evaluate answer</button>
    </form>
</div>
@endforeach
@endsection