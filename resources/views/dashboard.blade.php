@extends('layouts.dashboard')

@section('title', 'Dashboard | CareerPilot AI')

@section('content')
<div class="jobflow-dashboard-page">
    <div class="dashboard-home">
        <section class="dashboard-home-hero" aria-labelledby="dashboard-home-title">
            <img
                class="dashboard-home-hero-image"
                src="{{ asset('Modern Purple Workspace with Rocket Laptop.png') }}"
                alt=""
                aria-hidden="true"
            >
            <div class="dashboard-home-hero-content">
                <span class="dashboard-home-eyebrow">CareerPilot AI</span>
                <h1 id="dashboard-home-title">Welcome back, <span>{{ $firstName }}!</span></h1>
                <p>Plan, prepare, and grow your career with AI-powered tools.</p>
                <div class="dashboard-home-actions">
                    <a href="{{ route('ai-analysis.index') }}" class="dashboard-home-action dashboard-home-action--primary">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 14.2 9.8 21 12l-6.8 2.2L12 21l-2.2-6.8L3 12l6.8-2.2L12 3Z"/><path d="m18.5 3 .6 1.9L21 5.5l-1.9.6-.6 1.9-.6-1.9-1.9-.6 1.9-.6.6-1.9Z"/></svg>
                        Analyze Resume
                    </a>
                    <a href="{{ route('interviews.index') }}" class="dashboard-home-action dashboard-home-action--secondary">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="m10 8 6 4-6 4V8Z"/></svg>
                        Start Interview Practice
                    </a>
                </div>
            </div>
        </section>

        <section class="dashboard-home-stats" aria-label="Career summary">
            @foreach($summaryCards as $card)
            <article class="dashboard-stat-card dashboard-stat-card--{{ $card['tone'] }}">
                <div class="dashboard-stat-heading">
                    <span class="dashboard-stat-icon" aria-hidden="true">
                        @switch($card['icon'])
                        @case('applications')
                        <svg viewBox="0 0 24 24"><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><rect x="3" y="7" width="18" height="14" rx="2"/><path d="M3 12h18M10 12v2h4v-2"/></svg>
                        @break
                        @case('active')
                        <svg viewBox="0 0 24 24"><path d="m13 2-9 12h7l-1 8 10-13h-7l1-7Z"/></svg>
                        @break
                        @case('interview')
                        <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h3M8 17h7"/></svg>
                        @break
                        @case('offers')
                        <svg viewBox="0 0 24 24"><path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3l-5.6 2.9 1.1-6.2L3 9.6l6.2-.9L12 3Z"/></svg>
                        @break
                        @default
                        <svg viewBox="0 0 24 24"><path d="M4 19V9h4v10H4ZM10 19V5h4v14h-4ZM16 19v-7h4v7h-4Z"/></svg>
                    @endswitch
                    </span>
                    <h2>{{ $card['label'] }}</h2>
                </div>
                <strong class="dashboard-stat-value">{{ $card['value'] }}</strong>
                <p>{{ $card['description'] }}</p>
            </article>
            @endforeach
        </section>

        <section class="dashboard-home-overview">
            <article class="dashboard-home-panel dashboard-profile-panel">
                <header class="dashboard-panel-heading">
                    <span class="dashboard-panel-icon dashboard-panel-icon--purple" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="3"/><path d="M5 20a7 7 0 0 1 14 0M5 4v3M3.5 5.5h3M19 4v3M17.5 5.5h3"/></svg>
                    </span>
                    <div>
                        <h2>Profile Completion</h2>
                        <p>Complete your profile to unlock better job recommendations.</p>
                    </div>
                </header>

                <div class="dashboard-profile-content">
                    <div
                        class="dashboard-profile-ring"
                        style="--completion: {{ $profileScore }}%;"
                        role="img"
                        aria-label="Profile {{ $profileScore }} percent completed"
                    >
                        <div class="dashboard-profile-ring-center">
                            <strong>{{ $profileScore }}%</strong>
                            <span>Completed</span>
                        </div>
                    </div>
                    <ul class="dashboard-profile-checklist">
                        @foreach($profileChecklist as $item)
                        <li>
                            <span class="dashboard-checklist-mark {{ $item['complete'] ? 'is-complete' : '' }}" aria-hidden="true">
                                {{ $item['complete'] ? '✓' : '' }}
                            </span>
                            <span>{{ $item['label'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <a href="{{ route('profile.index') }}" class="dashboard-profile-action">
                    Complete Profile <span aria-hidden="true">→</span>
                </a>
            </article>

            <article class="dashboard-home-panel dashboard-application-panel">
                <header class="dashboard-application-heading">
                    <div class="dashboard-panel-heading">
                        <span class="dashboard-panel-icon dashboard-panel-icon--blue" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M4 19V9h4v10H4ZM10 19V5h4v14h-4ZM16 19v-7h4v7h-4Z"/></svg>
                        </span>
                        <div>
                            <h2>Application Overview</h2>
                            <p>Track your job applications and their status over time.</p>
                        </div>
                    </div>
                    <span class="dashboard-chart-period">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h3"/></svg>
                        Last 4 Weeks
                    </span>
                </header>

                <div class="dashboard-chart-legend" aria-label="Application statuses">
                    <span><i class="dashboard-legend-dot dashboard-legend-dot--applied"></i>Applied</span>
                    <span><i class="dashboard-legend-dot dashboard-legend-dot--interview"></i>Interview</span>
                    <span><i class="dashboard-legend-dot dashboard-legend-dot--offer"></i>Offer</span>
                </div>

                <div class="dashboard-application-chart">
                    <div class="dashboard-chart-axis" aria-hidden="true">
                        @foreach($applicationChartTicks as $tick)
                        <span>{{ $tick }}</span>
                        @endforeach
                    </div>
                    <div class="dashboard-chart-plot">
                        @if($hasApplicationChartData)
                        <div class="dashboard-chart-columns">
                            @foreach($applicationOverview as $week)
                            <div class="dashboard-chart-week">
                                <div class="dashboard-chart-bar-group">
                                    <span class="dashboard-chart-bar dashboard-chart-bar--applied" style="--bar-height: {{ $week['applied'] ? max(8, (int) round($week['applied'] / $applicationChartMax * 100)) : 0 }}%"></span>
                                    <span class="dashboard-chart-bar dashboard-chart-bar--interview" style="--bar-height: {{ $week['interviews'] ? max(8, (int) round($week['interviews'] / $applicationChartMax * 100)) : 0 }}%"></span>
                                    <span class="dashboard-chart-bar dashboard-chart-bar--offer" style="--bar-height: {{ $week['offers'] ? max(8, (int) round($week['offers'] / $applicationChartMax * 100)) : 0 }}%"></span>
                                </div>
                                <span class="dashboard-chart-week-label">{{ $week['label'] }}</span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="dashboard-chart-empty-state">
                            <svg viewBox="0 0 72 64" aria-hidden="true">
                                <path d="M13 8h30v38H13zM20 17h16M20 24h11M20 31h9" />
                                <circle cx="45" cy="37" r="11" />
                                <path d="m53 45 9 9M46 32v10M41 37h10" />
                            </svg>
                            <strong>No application data yet</strong>
                            <span>Start applying for jobs to see your progress here.</span>
                        </div>
                        @endif
                    </div>
                </div>
            </article>
        </section>

        <nav class="dashboard-home-shortcuts" aria-label="Career tools">
            <a href="{{ route('ai-analysis.index') }}" class="dashboard-shortcut-card dashboard-shortcut-card--purple">
                <span class="dashboard-shortcut-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6zM14 3v5h5M9 12h7M9 16h7M9 8h2"/></svg>
                </span>
                <span class="dashboard-shortcut-copy">
                    <strong>AI Resume Analysis</strong>
                    <span>Get AI-powered feedback to improve your resume and stand out.</span>
                </span>
                <span class="dashboard-shortcut-arrow" aria-hidden="true">→</span>
            </a>
            <a href="{{ route('interviews.index') }}" class="dashboard-shortcut-card dashboard-shortcut-card--orange">
                <span class="dashboard-shortcut-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="m10 8 6 4-6 4V8Z"/></svg>
                </span>
                <span class="dashboard-shortcut-copy">
                    <strong>Interview Practice</strong>
                    <span>Practice real interview questions with AI and get instant feedback.</span>
                </span>
                <span class="dashboard-shortcut-arrow" aria-hidden="true">→</span>
            </a>
            <a href="{{ route('reports.overview') }}" class="dashboard-shortcut-card dashboard-shortcut-card--green">
                <span class="dashboard-shortcut-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M4 19V9h4v10H4ZM10 19V5h4v14h-4ZM16 19v-7h4v7h-4Z"/></svg>
                </span>
                <span class="dashboard-shortcut-copy">
                    <strong>Progress Reports</strong>
                    <span>Track your learning, applications, and career progress over time.</span>
                </span>
                <span class="dashboard-shortcut-arrow" aria-hidden="true">→</span>
            </a>
        </nav>
    </div>
</div>
@endsection
