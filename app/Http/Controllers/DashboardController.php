<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $profile = $user?->profile;
        $profile?->loadMissing('skills');

        $jobs = $user?->jobApplications()->latest('applied_at')->get() ?? collect();
        $allApplications = $jobs->count();
        $activeApplications = $jobs->filter(fn ($job) => in_array(strtolower($job->status ?? ''), ['applied', 'saved', 'shortlisted', 'interviewing', 'in progress', 'pending'], true))->count();
        $waitingInterview = $jobs->filter(fn ($job) => in_array(strtolower($job->status ?? ''), ['interviewing', 'in progress', 'shortlisted'], true))->count();
        $offerReceived = $jobs->filter(fn ($job) => in_array(strtolower($job->status ?? ''), ['accepted', 'offered'], true))->count();
        $profileScore = min(100, max(0, (int) ($profile?->profile_score ?? 0)));

        $firstName = trim(explode(' ', $user?->name ?: 'User')[0] ?? 'User');
        $summaryCards = [
            [
                'label' => 'Total Applications',
                'value' => $allApplications,
                'description' => "Job applications you've sent so far.",
                'tone' => 'purple',
                'icon' => 'applications',
            ],
            [
                'label' => 'Active Applications',
                'value' => $activeApplications,
                'description' => 'Applications currently in progress.',
                'tone' => 'orange',
                'icon' => 'active',
            ],
            [
                'label' => 'Waiting for Interview',
                'value' => $waitingInterview,
                'description' => 'Applications pending an interview.',
                'tone' => 'green',
                'icon' => 'interview',
            ],
            [
                'label' => 'Offers Received',
                'value' => $offerReceived,
                'description' => "Job offers you've received.",
                'tone' => 'pink',
                'icon' => 'offers',
            ],
            [
                'label' => 'Profile Score',
                'value' => $profileScore.'%',
                'description' => 'Overall strength of your career profile.',
                'tone' => 'violet',
                'icon' => 'score',
            ],
        ];

        $profileChecklist = [
            ['label' => 'Basic Information', 'complete' => filled($user?->name) && filled($user?->email)],
            ['label' => 'Skills', 'complete' => $profile?->skills->isNotEmpty() ?? false],
            ['label' => 'Resume', 'complete' => $user?->resumes()->exists() ?? false],
            [
                'label' => 'Professional Details',
                'complete' => filled($profile?->professional_headline)
                    || filled($profile?->bio)
                    || (int) ($profile?->experience_years ?? 0) > 0,
            ],
            ['label' => 'Education', 'complete' => filled($profile?->education)],
        ];

        $applicationOverview = collect(range(0, 3))
            ->map(function (int $weekIndex) use ($jobs): array {
                $weekStart = now()->startOfWeek()->subWeeks(3 - $weekIndex);
                $weekEnd = $weekStart->copy()->endOfWeek();
                $weekJobs = $jobs->filter(function ($job) use ($weekStart, $weekEnd): bool {
                    return $job->applied_at
                        && $job->applied_at->greaterThanOrEqualTo($weekStart)
                        && $job->applied_at->lessThanOrEqualTo($weekEnd);
                });

                $counts = ['applied' => 0, 'interviews' => 0, 'offers' => 0];
                foreach ($weekJobs as $job) {
                    $status = strtolower($job->status ?? '');

                    if (in_array($status, ['accepted', 'offered'], true)) {
                        $counts['offers']++;
                    } elseif (in_array($status, ['interviewing', 'in progress', 'shortlisted'], true)) {
                        $counts['interviews']++;
                    } else {
                        $counts['applied']++;
                    }
                }

                return [
                    'label' => 'Week '.($weekIndex + 1),
                    ...$counts,
                    'total' => array_sum($counts),
                ];
            })
            ->all();

        $maxWeeklyApplications = max(array_column($applicationOverview, 'total'));
        $applicationChartMax = max(10, (int) (ceil($maxWeeklyApplications / 10) * 10));
        $applicationChartTicks = collect(range(0, 5))
            ->map(fn (int $tick) => (int) round($applicationChartMax * (1 - $tick / 5)))
            ->all();
        $hasApplicationChartData = collect($applicationOverview)->contains(fn ($week) => $week['total'] > 0);

        return view('dashboard', compact(
            'firstName',
            'summaryCards',
            'profileScore',
            'profileChecklist',
            'applicationOverview',
            'applicationChartMax',
            'applicationChartTicks',
            'hasApplicationChartData'
        ));
    }
}
