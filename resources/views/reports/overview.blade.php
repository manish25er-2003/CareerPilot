@extends('layouts.dashboard')

@section('title', 'Progress Report | CareerPilot AI')

@section('content')
@php
$shortlisted = $statusBreakdown
    ->filter(fn ($count, $status) => strtolower((string) $status) === 'shortlisted')
    ->sum();
$offers = $statusBreakdown
    ->filter(fn ($count, $status) => in_array(strtolower((string) $status), ['offered', 'accepted'], true))
    ->sum();
$applicationCount = $statusBreakdown->sum();
$readiness = max(0, min(100, $averageScore));
@endphp

<section class="report-page" aria-labelledby="report-page-title">
    <header class="report-page__header">
        <div class="report-page__title">
            <span class="report-page__title-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M4 19V5m0 14h17M8 16v-5m4 5V7m4 9v-7m4 7V4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <div>
                <h1 id="report-page-title">Progress Report</h1>
                <p>Track your application status, interview performance, and overall progress.</p>
            </div>
        </div>

        <div class="report-page__hero-art" aria-hidden="true">
            <svg viewBox="0 0 190 130" fill="none">
                <path d="M0 94c30-13 48-35 77-30 32 5 38 29 69 22 17-4 29-17 44-15v59H0V94Z" fill="#EEE9FF" />
                <path d="M0 105c28-12 48-26 72-21 31 6 49 25 78 15 16-5 25-14 40-15" stroke="#D8CEFF" stroke-width="2" />
                <rect x="38" y="14" width="70" height="89" rx="10" fill="white" stroke="#DCD3FF" stroke-width="2" />
                <circle cx="55" cy="33" r="6" fill="#8A6AF0" />
                <path d="M69 31h23M49 48h47M49 57h35" stroke="#D7D1EA" stroke-width="4" stroke-linecap="round" />
                <path d="M51 85V72m14 13V63m14 22V54m14 31V68" stroke="#7952E8" stroke-width="6" stroke-linecap="round" />
                <circle cx="131" cy="77" r="27" fill="#6F4BE3" />
                <path d="m120 77 7 7 15-16" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="m145 21 2.5 5.5L153 29l-5.5 2.5L145 37l-2.5-5.5L137 29l5.5-2.5L145 21Z" fill="#8D6BF0" />
                <circle cx="164" cy="48" r="3" fill="#B5A0FF" />
            </svg>
        </div>
    </header>

    <div class="report-stats" aria-label="Career progress summary">
        <article class="report-stat-card report-stat-card--applications">
            <span class="report-stat-card__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M7 3.75h7l5 5V20a1.25 1.25 0 0 1-1.25 1.25h-10.5A1.25 1.25 0 0 1 6 20V5a1.25 1.25 0 0 1 1-1.25Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                    <path d="M14 4v5h5M9 13h6m-6 3.5h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <div class="report-stat-card__copy">
                <span>Applications</span>
                <strong>{{ $totals['applications'] }}</strong>
            </div>
        </article>

        <article class="report-stat-card report-stat-card--interviews">
            <span class="report-stat-card__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <rect x="4" y="5.5" width="16" height="15" rx="2" stroke="currentColor" stroke-width="1.8" />
                    <path d="M8 3.5v4M16 3.5v4M4 9.5h16M8 13h2m4 0h2m-8 3.5h2m4 0h2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </span>
            <div class="report-stat-card__copy">
                <span>Interviews</span>
                <strong>{{ $totals['interviews'] }}</strong>
            </div>
        </article>

        <article class="report-stat-card report-stat-card--shortlisted">
            <span class="report-stat-card__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
                    <path d="m8 12.2 2.5 2.5 5.5-5.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <div class="report-stat-card__copy">
                <span>Shortlisted</span>
                <strong>{{ $shortlisted }}</strong>
            </div>
        </article>

        <article class="report-stat-card report-stat-card--offers">
            <span class="report-stat-card__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M8 4h8v4a4 4 0 0 1-8 0V4Zm0 2H5v2a4 4 0 0 0 4 4m7-6h3v2a4 4 0 0 1-4 4m-3 2v3m-4 2h8m-7-5h6l1 5H8l1-5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <div class="report-stat-card__copy">
                <span>Offers</span>
                <strong>{{ $offers }}</strong>
            </div>
        </article>
    </div>

    <div class="report-panels">
        <section class="report-panel report-panel--applications" aria-labelledby="application-breakdown-title">
            <h2 id="application-breakdown-title">Application status breakdown</h2>

            @if ($applicationCount > 0)
            <div class="report-status-list">
                @foreach ($statusBreakdown as $status => $count)
                @php
                $statusPercent = (int) round(($count / $applicationCount) * 100);
                $statusTone = match (strtolower((string) $status)) {
                    'offered', 'accepted' => 'is-success',
                    'rejected' => 'is-danger',
                    default => '',
                };
                @endphp
                <div class="report-status-row">
                    <div class="report-status-row__label">
                        <span>{{ $status ?: 'Other' }}</span>
                        <strong>{{ $count }}</strong>
                    </div>
                    <div class="report-status-track" role="progressbar" aria-label="{{ $status ?: 'Other' }} applications" aria-valuenow="{{ $statusPercent }}" aria-valuemin="0" aria-valuemax="100">
                        <span class="{{ $statusTone }}" style="width: {{ $statusPercent }}%"></span>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="report-empty-state">
                <span class="report-empty-state__icon" aria-hidden="true">
                    <svg viewBox="0 0 64 64" fill="none">
                        <path d="M18 8h20l12 12v18M38 9v12h12M24 28h13M24 35h9" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18 8a3 3 0 0 0-3 3v39a3 3 0 0 0 3 3h21" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                        <circle cx="42" cy="42" r="10" fill="white" stroke="currentColor" stroke-width="3" />
                        <path d="m49.5 49.5 7 7" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
                    </svg>
                </span>
                <strong>No application data yet</strong>
                <p>Your application status will appear here once you start applying.</p>
            </div>
            @endif
        </section>

        <section class="report-panel report-panel--readiness" aria-labelledby="interview-readiness-title">
            <h2 id="interview-readiness-title">Interview readiness</h2>
            <div class="report-readiness">
                <div class="report-readiness__ring" style="--readiness-progress: {{ $readiness }}%" role="img" aria-label="Interview readiness: {{ $readiness }} percent">
                    <span>{{ $readiness }}%</span>
                </div>
                <div class="report-readiness__copy">
                    <strong>{{ $readiness > 0 ? 'You’re making progress!' : 'You’re getting started!' }}</strong>
                    <p>{{ $readiness > 0 ? 'Your average interview score across completed sessions.' : 'Complete applications and interviews to see your readiness score improve.' }}</p>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection
