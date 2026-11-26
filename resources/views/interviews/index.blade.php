@extends('layouts.dashboard')

@section('title', 'Interview Practice | CareerPilot AI')

@section('content')
<div class="interview-page">
    <header class="interview-page__hero">
        <div class="interview-page__title">
            <span class="interview-page__title-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="6" width="12" height="12" rx="2.5" stroke="currentColor" stroke-width="1.8" />
                    <path d="m15 10 5-3v10l-5-3v-4Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <div>
                <h1>Interview Practice</h1>
                <p>Practice real interview questions, get instant feedback, and improve your performance.</p>
            </div>
        </div>

        <div class="interview-page__hero-art" aria-hidden="true">
            <svg viewBox="0 0 210 128" fill="none">
                <path d="M0 95c35-13 51-34 83-29 31 5 41 28 72 22 22-4 35-17 55-16v56H0V95Z" fill="#EEE9FF" />
                <path d="M0 106c31-12 53-26 82-21 31 5 45 24 75 15 20-6 34-15 53-16" stroke="#D8CEFF" stroke-width="2" />
                <rect x="32" y="20" width="103" height="68" rx="7" fill="white" stroke="#7160D4" stroke-width="2.5" />
                <rect x="39" y="27" width="89" height="53" rx="3" fill="#F7F4FF" />
                <circle cx="83" cy="45" r="11" fill="#8C70EF" />
                <path d="M65 70c2-10 9-15 18-15s16 5 18 15" fill="#704CE3" />
                <path d="M21 90h126l-9 10H30l-9-10Z" fill="white" stroke="#7160D4" stroke-width="2.5" stroke-linejoin="round" />
                <rect x="113" y="9" width="62" height="37" rx="9" fill="#8562EB" />
                <path d="M126 21h34m-34 9h23" stroke="white" stroke-width="3" stroke-linecap="round" />
                <path d="m164 53 2 4.5 4.5 2-4.5 2-2 4.5-2-4.5-4.5-2 4.5-2 2-4.5Z" fill="#9A80F2" />
                <circle cx="187" cy="76" r="3" fill="#B5A0FF" />
            </svg>
        </div>
    </header>

    <section class="interview-card interview-start-card" aria-labelledby="interview-start-title">
        <header class="interview-card__heading">
            <span class="interview-card__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
                    <path d="m10 8.5 6 3.5-6 3.5v-7Z" fill="currentColor" />
                </svg>
            </span>
            <div>
                <h2 id="interview-start-title">Start a Mock Interview</h2>
                <p>Choose your role, category, and difficulty level to begin a practice session.</p>
            </div>
        </header>

        <form method="POST" action="{{ route('interviews.store') }}" class="interview-form row g-3">
            @csrf

            <div class="col-md-4">
                <label for="interview-role" class="form-label">Role</label>
                <div class="interview-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.8" />
                        <path d="M5 20v-1.5a7 7 0 0 1 14 0V20H5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                    </svg>
                    <input id="interview-role" type="text" name="role" list="interview-role-options" value="{{ old('role') }}" placeholder="e.g. Product Manager" required aria-invalid="{{ $errors->has('role') ? 'true' : 'false' }}">
                    <datalist id="interview-role-options">
                        <option value="Product Manager"></option>
                        <option value="Software Engineer"></option>
                        <option value="Data Analyst"></option>
                    </datalist>
                </div>
                @error('role')
                <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="interview-category" class="form-label">Category</label>
                <div class="interview-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5M3 16.5l9 4.5 9-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <select id="interview-category" name="category" required aria-invalid="{{ $errors->has('category') ? 'true' : 'false' }}">
                        @foreach ([
                            'Behavioural' => 'Behavioral',
                            'Technical' => 'Technical',
                            'HR' => 'HR',
                            'Programming' => 'Programming',
                            'Database' => 'Database',
                            'Framework-specific' => 'Framework-specific',
                        ] as $value => $label)
                        <option value="{{ $value }}" @selected(old('category', 'Behavioural') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="interview-difficulty" class="form-label">Difficulty</label>
                <div class="interview-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 19V12m5 7V8m5 11V5m5 14V3" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" />
                    </svg>
                    <select id="interview-difficulty" name="difficulty" required aria-invalid="{{ $errors->has('difficulty') ? 'true' : 'false' }}">
                        <option value="Easy" @selected(old('difficulty', 'Medium') === 'Easy')>Beginner</option>
                        <option value="Medium" @selected(old('difficulty', 'Medium') === 'Medium')>Intermediate</option>
                        <option value="Hard" @selected(old('difficulty', 'Medium') === 'Hard')>Advanced</option>
                    </select>
                </div>
                @error('difficulty')
                <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 interview-form__actions">
                <button type="submit" class="btn btn-primary-custom text-white">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m8 5 11 7-11 7V5Z" fill="currentColor" />
                    </svg>
                    Begin Interview
                </button>
            </div>
        </form>
    </section>

    <section class="interview-how-card" aria-labelledby="interview-how-title">
        <div class="interview-how-card__intro">
            <h2 id="interview-how-title">How It Works</h2>
            <p>Get interview-ready in three simple steps.</p>
        </div>

        <ol class="interview-steps">
            <li class="interview-step">
                <span class="interview-step__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="m8 5 11 7-11 7V5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                    </svg>
                </span>
                <div>
                    <h3>1. Set Up</h3>
                    <p>Choose your role and practice type.</p>
                </div>
            </li>
            <li class="interview-step">
                <span class="interview-step__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5v8a2.5 2.5 0 0 1-2.5 2.5H11l-5 4v-4.4A2.5 2.5 0 0 1 4 13.5v-8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        <circle cx="9" cy="9.5" r="1" fill="currentColor" />
                        <circle cx="12" cy="9.5" r="1" fill="currentColor" />
                        <circle cx="15" cy="9.5" r="1" fill="currentColor" />
                    </svg>
                </span>
                <div>
                    <h3>2. Practice</h3>
                    <p>Answer realistic interview questions.</p>
                </div>
            </li>
            <li class="interview-step">
                <span class="interview-step__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 20V12m5 8V8m5 12V4m5 16v-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" />
                    </svg>
                </span>
                <div>
                    <h3>3. Get Feedback</h3>
                    <p>Receive instant feedback and tips.</p>
                </div>
            </li>
        </ol>
    </section>

    @if ($sessions->isNotEmpty())
    <section class="interview-history" aria-labelledby="interview-history-title">
        <div class="interview-history__heading">
            <div>
                <h2 id="interview-history-title">Your Practice Sessions</h2>
                <p>Pick up where you left off or review your previous results.</p>
            </div>
            <span>{{ $sessions->count() }} {{ \Illuminate\Support\Str::plural('session', $sessions->count()) }}</span>
        </div>

        <div class="interview-history__grid">
            @foreach ($sessions as $session)
            <article class="interview-session-card">
                <div class="interview-session-card__top">
                    <div class="interview-session-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M4 7.5A2.5 2.5 0 0 1 6.5 5h11A2.5 2.5 0 0 1 20 7.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 16.5v-9Z" stroke="currentColor" stroke-width="1.8" />
                            <path d="m10 9 5 3-5 3V9Z" fill="currentColor" />
                        </svg>
                    </div>
                    <span class="interview-session-card__score">{{ $session->total_score ?? 0 }}%</span>
                </div>
                <h3>{{ $session->role }}</h3>
                <p>{{ $session->category }} <span aria-hidden="true">·</span> {{ $session->difficulty }}</p>
                <div class="interview-session-card__footer">
                    <span>{{ $session->questions->count() }} questions</span>
                    <a href="{{ route('interviews.show', $session->id) }}">Open session <span aria-hidden="true">→</span></a>
                </div>
            </article>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
