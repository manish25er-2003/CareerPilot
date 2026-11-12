@extends('layouts.dashboard')

@section('title', 'Dashboard | CareerPilot AI')

@section('content')
@php
    $authUser = auth()->user();
    $profile = $authUser?->profile;
    $profileImage = $profile && $profile->profile_image ? \Illuminate\Support\Facades\Storage::url($profile->profile_image) : null;
    $displayName = $authUser?->name ?: 'User';
    $displayEmail = $authUser?->email ?: 'user@example.com';
    $initials = collect(explode(' ', trim($displayName)))
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');
@endphp
<div class="jobflow-dashboard-shell">
    <aside class="jobflow-sidebar">
        <div class="jobflow-logo">
            <span class="jobflow-logo-mark">J</span>
            <span>Jobflow</span>
        </div>

        <div class="jobflow-menu-label">Main Menu</div>
        <nav class="jobflow-nav">
            <a class="active" href="#">Dashboard</a>
            <a href="#">Job Listings</a>
            <a href="#">My Applications</a>
            <a href="#">Interview Schedule</a>
        </nav>

        <div class="jobflow-menu-label bottom-menu">Other</div>
        <nav class="jobflow-nav secondary">
            @foreach($footerLinks as $link)
                <a href="#">{{ $link }}</a>
            @endforeach
            <div class="jobflow-user-chip">
                <span class="jobflow-user-avatar">
                    @if ($profileImage)
                        <img src="{{ $profileImage }}" alt="{{ $displayName }}" />
                    @else
                        {{ $initials ?: 'U' }}
                    @endif
                </span>
                <div>
                    <strong>{{ $displayName }}</strong>
                    <small>{{ $displayEmail }}</small>
                </div>
            </div>
        </nav>
    </aside>

    <main class="jobflow-main-panel">
        <header class="jobflow-header-bar">
            <div class="jobflow-title-wrap">
                <div class="jobflow-icon-badge">◌</div>
                <div>
                    <h2>Welcome Back, {{ $firstName ?? explode(' ', $displayName)[0] }}!</h2>
                    <p>Your Career Journey Starts Here. Track and Manage Your Applications Seamlessly.</p>
                </div>
            </div>

            <div class="jobflow-header-actions">
                <div class="jobflow-search">
                    <span>⌕</span>
                    <input type="text" value="Search" aria-label="Search" />
                </div>
                <div class="jobflow-user-panel">
                    <button type="button" class="jobflow-notification-btn" aria-label="Notifications">🔔</button>
                    <div class="jobflow-user-mini-card">
                        <span class="jobflow-user-avatar small">
                            @if ($profileImage)
                                <img src="{{ $profileImage }}" alt="{{ $displayName }}" />
                            @else
                                {{ $initials ?: 'U' }}
                            @endif
                        </span>
                        <div>
                            <strong>{{ $displayName }}</strong>
                            <small>{{ $displayEmail }}</small>
                        </div>
                    </div>
                </div>
                <button type="button" class="jobflow-cta-button">Post Resume</button>
            </div>
        </header>

        <div class="jobflow-upper-grid">
            <div class="jobflow-stat-grid">
                @foreach($summaryCards as $card)
                    <div class="jobflow-stat-card {{ $card['active'] ? 'is-primary' : '' }}">
                        <div class="jobflow-stat-header">
                            <span>{{ $card['label'] }}</span>
                            <span class="jobflow-arrow">→</span>
                        </div>
                        <div class="jobflow-stat-value">{{ $card['value'] }}</div>
                        <div class="jobflow-stat-meta">{{ $card['meta'] }}</div>
                    </div>
                @endforeach
            </div>

            <div class="jobflow-schedule-card">
                <div class="jobflow-card-header">
                    <h3>Schedule</h3>
                    <button type="button" class="jobflow-mini-icon">◍</button>
                </div>

                <div class="jobflow-calendar-head">
                    <span>◀</span>
                    <strong>November 2024</strong>
                    <span>▶</span>
                </div>

                @foreach($schedule as $item)
                    <div class="jobflow-schedule-item">
                        <div class="jobflow-date-box">
                            <span>{{ collect(str_split(date('M', strtotime('2024-11-01'))))->take(3)->implode('') }}</span>
                        </div>
                        <div class="jobflow-schedule-text">
                            <div class="jobflow-schedule-name">{{ $item['title'] }}</div>
                            <div class="jobflow-schedule-meta">{{ $item['company'] }}</div>
                            <div class="jobflow-schedule-meta">{{ $item['time'] }}</div>
                        </div>
                        <button type="button" class="jobflow-next-icon">→</button>
                    </div>
                @endforeach

                <button type="button" class="jobflow-link-button">See All</button>
            </div>
        </div>

        <div class="jobflow-lower-grid">
            <div class="jobflow-donut-card">
                <div class="jobflow-card-title-row">
                    <h3>Resume Strength Analyzer</h3>
                </div>

                <div class="jobflow-donut-wrap">
                    <div class="jobflow-donut-ring">
                        <div class="jobflow-donut-center">
                            <span>85%</span>
                        </div>
                    </div>
                </div>

                <div class="jobflow-score-list">
                    @foreach($resumeStrength as $label => $score)
                        <div class="jobflow-score-row">
                            <span>{{ $label }}</span>
                            <div class="jobflow-score-bar">
                                <span style="width: {{ $score }}%"></span>
                            </div>
                            <strong>{{ $score }}%</strong>
                        </div>
                    @endforeach
                </div>

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

                <div class="jobflow-pagination">
                    <span>Page 1 of 12</span>
                    <div>
                        <button type="button">←</button>
                        <button type="button">→</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="jobflow-bottom-grid">
            <div class="jobflow-purple-cta">
                <span class="jobflow-cta-label">Mastering Behavioral Interviews</span>
                <h3>Strategies to succeed in competency-based interviews</h3>
                <button type="button">Learn More →</button>
            </div>

            <div class="jobflow-recommendation-panel">
                <div class="jobflow-card-header jobflow-recommend-header">
                    <h3>Recommended Jobs</h3>
                    <button type="button" class="jobflow-link-button subtle">See All</button>
                </div>

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
            </div>
        </div>
    </main>
</div>
@endsection
