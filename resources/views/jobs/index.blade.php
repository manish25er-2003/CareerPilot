@extends('layouts.dashboard')

@section('title', 'Job Applications | CareerPilot AI')

@section('content')
<div class="jobs-page">
    <header class="jobs-page__hero">
        <div class="jobs-page__title">
            <span class="jobs-page__title-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="7" width="18" height="13" rx="2.5" stroke="currentColor" stroke-width="1.8" />
                    <path d="M8 7V5.5A1.5 1.5 0 0 1 9.5 4h5A1.5 1.5 0 0 1 16 5.5V7m-13 5h18m-11 0v2h4v-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <div>
                <h1>Job Applications</h1>
                <p>Track, manage, and stay organized with your job applications.</p>
            </div>
        </div>

        <div class="jobs-page__hero-art" aria-hidden="true">
            <svg viewBox="0 0 190 120" fill="none">
                <path d="M0 94c29-7 46-19 73-16 30 3 39 20 67 15 19-4 30-13 50-13v40H0V94Z" fill="#EEE9FF" />
                <path d="M0 102c29-8 49-16 73-13 28 4 41 16 67 11 19-4 31-10 50-11" stroke="#D8CEFF" stroke-width="2" />
                <rect x="29" y="17" width="86" height="63" rx="9" fill="white" stroke="#8065E8" stroke-width="2.5" />
                <circle cx="52" cy="38" r="9" fill="#9A83F2" />
                <path d="M39 59c1-8 6-12 13-12s12 4 13 12" fill="#7655E3" />
                <path d="M73 33h28m-28 10h28m-28 10h18" stroke="#C9BDF8" stroke-width="4" stroke-linecap="round" />
                <rect x="91" y="64" width="68" height="43" rx="8" fill="#7552E3" />
                <path d="M109 64v-5a6 6 0 0 1 6-6h20a6 6 0 0 1 6 6v5m-50 13h68m-40 0v7h12v-7" stroke="#5938CE" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="m160 28 7-8m3 14 9-2m-19-9 1-8" stroke="#9A80F2" stroke-width="3" stroke-linecap="round" />
            </svg>
        </div>
    </header>

    <section class="jobs-card jobs-form-card" aria-labelledby="job-form-title">
        <header class="jobs-card__heading">
            <span class="jobs-card__heading-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 5v14m-7-7h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" />
                </svg>
            </span>
            <div>
                <h2 id="job-form-title">Add Job Application</h2>
                <p>Record a new job application and keep track of its progress.</p>
            </div>
        </header>

        <form method="POST" action="{{ route('jobs.store') }}" class="jobs-form row g-3">
            @csrf
            <div class="col-md-6 col-xl-4">
                <label for="job-company" class="form-label">Company <span>*</span></label>
                <div class="jobs-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 20V6.5A1.5 1.5 0 0 1 5.5 5h9A1.5 1.5 0 0 1 16 6.5V20M2.5 20h19M8 9h1m3 0h1m-5 4h1m3 0h1m2-1h4.5a1 1 0 0 1 1 1v7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input id="job-company" type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Enter company name" required aria-invalid="{{ $errors->has('company_name') ? 'true' : 'false' }}">
                </div>
                @error('company_name')
                <div class="jobs-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 col-xl-4">
                <label for="job-title" class="form-label">Job Title <span>*</span></label>
                <div class="jobs-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="3" y="7" width="18" height="13" rx="2.5" stroke="currentColor" stroke-width="1.7" />
                        <path d="M8 7V5.5A1.5 1.5 0 0 1 9.5 4h5A1.5 1.5 0 0 1 16 5.5V7m-4 5v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                    </svg>
                    <input id="job-title" type="text" name="job_title" value="{{ old('job_title', $suggestedJobTitle) }}" placeholder="Enter job title" required aria-invalid="{{ $errors->has('job_title') ? 'true' : 'false' }}">
                </div>
                @error('job_title')
                <div class="jobs-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 col-xl-4">
                <label for="job-status" class="form-label">Status <span>*</span></label>
                <div class="jobs-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 19V12m5 7V8m5 11V5m5 14V3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                    <select id="job-status" name="status" aria-invalid="{{ $errors->has('status') ? 'true' : 'false' }}">
                        @foreach (['Saved', 'Applied', 'Shortlisted', 'Interviewing', 'Offered', 'Rejected'] as $status)
                        <option value="{{ $status }}" @selected(old('status', 'Applied') === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                @error('status')
                <div class="jobs-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 col-xl-4">
                <label for="job-location" class="form-label">Location</label>
                <div class="jobs-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M19 10.2c0 5-7 10.3-7 10.3S5 15.2 5 10.2a7 7 0 1 1 14 0Z" stroke="currentColor" stroke-width="1.8" />
                        <circle cx="12" cy="10" r="2.2" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                    <input id="job-location" type="text" name="location" value="{{ old('location') }}" placeholder="Enter job location" aria-invalid="{{ $errors->has('location') ? 'true' : 'false' }}">
                </div>
                @error('location')
                <div class="jobs-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 col-xl-4">
                <label for="job-type" class="form-label">Job Type</label>
                <div class="jobs-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5M3 16.5l9 4.5 9-4.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input id="job-type" type="text" name="job_type" value="{{ old('job_type') }}" placeholder="e.g. Full-Time" aria-invalid="{{ $errors->has('job_type') ? 'true' : 'false' }}">
                </div>
                @error('job_type')
                <div class="jobs-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 col-xl-4">
                <label for="job-applied-date" class="form-label">Applied Date</label>
                <div class="jobs-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="4" y="5" width="16" height="16" rx="2" stroke="currentColor" stroke-width="1.7" />
                        <path d="M8 3v4m8-4v4M4 10h16" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                    </svg>
                    <input id="job-applied-date" type="date" name="applied_at" value="{{ old('applied_at') }}" aria-invalid="{{ $errors->has('applied_at') ? 'true' : 'false' }}">
                </div>
                @error('applied_at')
                <div class="jobs-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="job-url" class="form-label">Job URL</label>
                <div class="jobs-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m10 13.5 4-4m-6.2 7.7-1.6 1.6a3 3 0 0 1-4.2-4.2l4.4-4.4a3 3 0 0 1 4.2 0m5.4 0 1.6-1.6a3 3 0 0 1 4.2 4.2l-4.4 4.4a3 3 0 0 1-4.2 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                    <input id="job-url" type="url" name="job_url" value="{{ old('job_url') }}" placeholder="https://" aria-invalid="{{ $errors->has('job_url') ? 'true' : 'false' }}">
                </div>
                @error('job_url')
                <div class="jobs-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="job-salary" class="form-label">Salary Range</label>
                <div class="jobs-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m20 13-7 7L3 10V4h6l11 9Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        <circle cx="7.5" cy="7.5" r="1.2" fill="currentColor" />
                    </svg>
                    <input id="job-salary" type="text" name="salary_range" value="{{ old('salary_range') }}" placeholder="e.g. $120k - $150k" aria-invalid="{{ $errors->has('salary_range') ? 'true' : 'false' }}">
                </div>
                @error('salary_range')
                <div class="jobs-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="job-notes" class="form-label">Notes</label>
                <div class="jobs-control jobs-control--textarea">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 3.5h7l5 5V20a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                        <path d="M14 4v5h5m-9 4h5m-5 3h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                    </svg>
                    <textarea id="job-notes" name="notes" rows="2" placeholder="Add notes (e.g. application updates, interview details, follow-ups)..." aria-invalid="{{ $errors->has('notes') ? 'true' : 'false' }}">{{ old('notes') }}</textarea>
                </div>
                @error('notes')
                <div class="jobs-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 jobs-form__actions">
                <button type="submit" class="btn jobs-button jobs-button--primary">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 5v14m-7-7h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" />
                    </svg>
                    Save Application
                </button>
                <button type="reset" class="btn jobs-button jobs-button--secondary">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M20 11a8 8 0 0 0-14.8-4L3 10m0-5v5h5m-4 3a8 8 0 0 0 14.8 4L21 14m0 5v-5h-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Clear
                </button>
            </div>
        </form>
    </section>

    <section class="jobs-card jobs-tracking-card" aria-labelledby="jobs-tracking-title">
        <header class="jobs-card__heading jobs-tracking-card__heading">
            <span class="jobs-card__heading-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
                    <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <div>
                <h2 id="jobs-tracking-title">Recent Tracking</h2>
                <p>Your latest job applications and their status.</p>
            </div>
        </header>

        <div class="jobs-table-wrap">
            <table class="jobs-table">
                <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Location</th>
                        <th scope="col">Status</th>
                        <th scope="col">Applied Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                    <tr>
                        <td class="jobs-table__company">{{ $job->company_name }}</td>
                        <td>{{ $job->job_title }}</td>
                        <td>{{ $job->location ?? '—' }}</td>
                        <td><span class="jobs-status">{{ $job->status }}</span></td>
                        <td>{{ $job->applied_at ? \Carbon\Carbon::parse($job->applied_at)->format('M d, Y') : '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="jobs-empty-state">
                                <span class="jobs-empty-state__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <rect x="3" y="7" width="18" height="13" rx="2.5" stroke="currentColor" stroke-width="1.8" />
                                        <path d="M8 7V5.5A1.5 1.5 0 0 1 9.5 4h5A1.5 1.5 0 0 1 16 5.5V7m-13 5h18m-11 0v2h4v-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <strong>No applications yet</strong>
                                <span>Add your first job application to start tracking.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection