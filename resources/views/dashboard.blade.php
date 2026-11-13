@extends('layouts.dashboard')

@section('title', 'Dashboard | CareerPilot AI')

@section('content')
@php
$authUser = auth()->user();
$profile = $authUser?->profile;
$profileImage = $profile && $profile->profile_image ? \Illuminate\Support\Facades\Storage::url($profile->profile_image) : null;
$displayName = $authUser?->name ?: 'User';
$firstName = trim(explode(' ', $displayName)[0] ?? 'User');
$initials = collect(explode(' ', trim($displayName)))
->map(fn ($part) => strtoupper(substr($part, 0, 1)))
->take(2)
->implode('');
$hour = now()->hour;
$greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening' );
    $score=$resumeScore ?? 0;
    @endphp

    <div class="jobflow-dashboard-page">
    <div class="jobflow-hero-banner">
        <div class="jobflow-hero-copy">
            <span class="jobflow-hero-pill">Your Career Journey Starts Here</span>
            <h2>Welcome back, {{ $firstName }}!</h2>
            <p>Let’s find your next opportunity together with CareerPilot AI.</p>
            <a href="{{ route('jobs.index') }}" class="jobflow-cta-button">Explore Opportunities →</a>
        </div>
        <div class="jobflow-hero-visual" aria-hidden="true">
            <div class="jobflow-hero-device">
                <div class="jobflow-hero-screen"></div>
            </div>
            <div class="jobflow-mini-card jobflow-mini-card--chart">📈</div>
            <div class="jobflow-mini-card jobflow-mini-card--briefcase">💼</div>
            <div class="jobflow-mini-card jobflow-mini-card--note">📝</div>
        </div>
    </div>

    <div class="jobflow-upper-grid">
        <div class="jobflow-stat-grid">
            @forelse($summaryCards as $card)
            <div class="jobflow-stat-card {{ $card['active'] ? 'is-primary' : '' }}">
                <div class="jobflow-stat-header">
                    <span>{{ $card['label'] }}</span>
                    <span class="jobflow-arrow">→</span>
                </div>
                <div class="jobflow-stat-value">{{ $card['value'] }}</div>
                <div class="jobflow-stat-meta">{{ $card['meta'] }}</div>
            </div>
            @empty
            <div class="jobflow-stat-card is-primary">
                <div class="jobflow-stat-header">
                    <span>Summary</span>
                    <span class="jobflow-arrow">→</span>
                </div>
                <div class="jobflow-stat-value">0</div>
                <div class="jobflow-stat-meta">No application activity yet.</div>
            </div>
            @endforelse
        </div>

        <div class="jobflow-schedule-card">
            <div class="jobflow-card-header">
                <h3>Schedule</h3>
                <button type="button" class="jobflow-mini-icon">◍</button>
            </div>

            @if($schedule)
            <div class="jobflow-calendar-head">
                <span>◀</span>
                <strong>{{ now()->monthName }} {{ now()->year }}</strong>
                <span>▶</span>
            </div>

            @foreach($schedule as $item)
            <div class="jobflow-schedule-item">
                <div class="jobflow-date-box">
                    <span>{{ \Illuminate\Support\Str::substr($item['date'] ?? 'N/A', 0, 3) }}</span>
                </div>
                <div class="jobflow-schedule-text">
                    <div class="jobflow-schedule-name">{{ $item['title'] }}</div>
                    <div class="jobflow-schedule-meta">{{ $item['company'] }}</div>
                    <div class="jobflow-schedule-meta">{{ $item['date'] }} · {{ $item['time'] }}</div>
                </div>
                <button type="button" class="jobflow-next-icon">→</button>
            </div>
            @endforeach
            @else
            <div class="text-center text-secondary-custom py-4">No interviews scheduled yet.</div>
            @endif

            <button type="button" class="jobflow-link-button">See All</button>
        </div>
    </div>

    <div class="jobflow-lower-grid">
        <div class="jobflow-donut-card">
            <div class="jobflow-card-title-row">
                <h3>Resume Strength Analyzer</h3>
            </div>

            <div class="jobflow-donut-wrap">
                <div class="jobflow-donut-ring" style="background: conic-gradient(#4f46e5 0 {{ $score }}%, #edf2ff {{ $score }}% 100%);">
                    <div class="jobflow-donut-center">
                        <span>{{ $score }}%</span>
                    </div>
                </div>
            </div>

            @if($resumeStrength)
            <div class="jobflow-score-list">
                @foreach($resumeStrength as $label => $scoreValue)
                <div class="jobflow-score-row">
                    <span>{{ $label }}</span>
                    <div class="jobflow-score-bar">
                        <span style="width: {{ $scoreValue }}%"></span>
                    </div>
                    <strong>{{ $scoreValue }}%</strong>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center text-secondary-custom py-4">No resume analysis available yet.</div>
            @endif

            <button type="button" class="jobflow-primary-button">Improve Resume</button>
        </div>

        <div class="jobflow-table-card">
            <div class="jobflow-card-header jobflow-table-header">
                <h3>Latest Application Status</h3>
                <div class="jobflow-table-tools">
                    <span>⌕</span>
                    <span>◌</span>
                </div>
            </div>

            @if($applicationRows)
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Applied On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicationRows as $row)
                    <tr>
                        <td class="jobflow-company-cell">
                            <span class="jobflow-company-icon {{ strtolower(str_replace(' ', '-', $row['company'])) }}">{{ strtoupper(substr($row['company'], 0, 1)) }}</span>
                            <div>
                                <strong>{{ $row['company'] }}</strong>
                                <small>{{ $row['location'] }}</small>
                            </div>
                        </td>
                        <td>{{ $row['role'] }}</td>
                        <td>
                            <span class="jobflow-badge jobflow-badge-{{ $row['statusClass'] }}">{{ $row['status'] }}</span>
                        </td>
                        <td>{{ $row['date'] }}</td>
                        <td class="jobflow-action-cell">⋯</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-center text-secondary-custom py-4">No applications yet.</div>
            @endif

            <div class="jobflow-pagination">
                <span>Page 1 of 1</span>
                <div>
                    <button type="button">←</button>
                    <button type="button">→</button>
                </div>
            </div>
        </div>
    </div>

    <div class="jobflow-bottom-grid">
        <div class="jobflow-purple-cta">
            <span class="jobflow-cta-label">Career Momentum</span>
            <h3>Keep building your professional profile with consistent action.</h3>
            <button type="button">Learn More →</button>
        </div>

        <div class="jobflow-recommendation-panel">
            <div class="jobflow-card-header jobflow-recommend-header">
                <h3>Recommended Jobs</h3>
                <button type="button" class="jobflow-link-button subtle">See All</button>
            </div>

            @if($recommendedJobs)
            <div class="jobflow-job-grid">
                @foreach($recommendedJobs as $job)
                <div class="jobflow-job-card jobflow-job-card-{{ $job['tone'] }}">
                    <div class="jobflow-job-meta">{{ $job['days'] }}</div>
                    <div class="jobflow-job-title-row">
                        <div>
                            <strong>{{ $job['title'] }}</strong>
                            <small>{{ $job['company'] }}</small>
                        </div>
                        <span class="jobflow-job-bookmark">◫</span>
                    </div>
                    <div class="jobflow-job-footer">
                        <span>{{ $job['location'] }}</span>
                        <span class="jobflow-job-icon">◌</span>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center text-secondary-custom py-4">No role recommendations yet.</div>
            @endif
        </div>
    </div>
    </div>
    @endsection