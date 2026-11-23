<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $profile = $user?->profile;

        $jobs = $user?->jobApplications()->latest('applied_at')->get() ?? collect();
        $allApplications = $jobs->count();
        $activeApplications = $jobs->filter(fn($job) => in_array(strtolower($job->status ?? ''), ['applied', 'saved', 'shortlisted', 'interviewing', 'in progress', 'pending'], true))->count();
        $waitingInterview = $jobs->filter(fn($job) => in_array(strtolower($job->status ?? ''), ['interviewing', 'in progress', 'shortlisted'], true))->count();
        $offerReceived = $jobs->filter(fn($job) => in_array(strtolower($job->status ?? ''), ['accepted', 'offered'], true))->count();

        $displayName = $user?->name ?: 'User';
        $displayEmail = $user?->email ?: 'user@example.com';
        $firstName = trim(explode(' ', $displayName)[0] ?? 'User');
        $initials = collect(explode(' ', trim($displayName)))
            ->map(fn($part) => strtoupper(substr($part, 0, 1)))
            ->take(2)
            ->implode('');

        $profileImage = $profile && $profile->profile_image
            ? Storage::url($profile->profile_image)
            : null;

        $summaryCards = [
            ['label' => 'Total Applications Sent', 'value' => $allApplications, 'meta' => '', 'active' => true],
            ['label' => 'Active Applications', 'value' => $activeApplications, 'meta' => '', 'active' => false],
            ['label' => 'Waiting for Interview', 'value' => $waitingInterview, 'meta' => '', 'active' => false],
            ['label' => 'Offers Received', 'value' => $offerReceived, 'meta' => '', 'active' => false],
        ];

        $schedule = $jobs
            ->filter(fn($job) => ! empty($job->interview_date))
            ->sortBy('interview_date')
            ->take(3)
            ->map(function ($job) {
                return [
                    'title' => $job->job_title,
                    'company' => $job->company_name,
                    'date' => $job->interview_date?->format('M d, Y') ?? 'Schedule pending',
                    'time' => $job->interview_date?->format('h:i A') ?? 'TBD',
                    'badge' => $job->status,
                ];
            })
            ->values()
            ->all();

        $applicationRows = $jobs
            ->take(5)
            ->map(function ($job) {
                return [
                    'company' => $job->company_name,
                    'role' => $job->job_title,
                    'location' => $job->location,
                    'status' => $job->status,
                    'statusClass' => $this->statusClass($job->status),
                    'date' => $job->applied_at?->translatedFormat('d M Y') ?? 'N/A',
                ];
            })
            ->values()
            ->all();

        $resumeStrength = $this->buildResumeStrength($user);
        $resumeScore = empty($resumeStrength)
            ? 0
            : (int) round(array_sum($resumeStrength) / count($resumeStrength));

        $recommendedJobs = $jobs
            ->take(3)
            ->map(function ($job, $index) {
                return [
                    'title' => $job->job_title,
                    'company' => $job->company_name,
                    'location' => $job->location,
                    'days' => $job->applied_at ? $job->applied_at->diffForHumans() : 'Recently added',
                    'tone' => ['purple', 'light', 'soft'][$index % 3],
                ];
            })
            ->values()
            ->all();

        return view('dashboard', compact(
            'user',
            'displayName',
            'displayEmail',
            'firstName',
            'initials',
            'profileImage',
            'summaryCards',
            'schedule',
            'applicationRows',
            'resumeStrength',
            'recommendedJobs',
            'resumeScore'
        ));
    }

    protected function buildResumeStrength(?\App\Models\User $user): array
    {
        $analysis = $user?->aiAnalyses()->latest()->first();
        $interview = $user?->interviewSessions()->latest()->first();

        if (! $analysis && ! $interview) {
            return [];
        }

        $strength = [];

        if ($analysis) {
            $match = max(0, min(100, (int) round($analysis->match_percentage ?? $analysis->overall_score ?? 0)));
            $strength['Profile Summary'] = $match;
            $strength['ATS Match'] = $match;
            $strength['Skill Fit'] = max(0, min(100, (int) round($analysis->overall_score ?? $match)));
        }

        if ($interview) {
            $strength['Interview Ready'] = max(0, min(100, (int) round($interview->total_score ?? 0)));
        }

        return $strength;
    }

    protected function statusClass(?string $status): string
    {
        return match (strtolower($status ?? '')) {
            'accepted', 'offered' => 'success',
            'interviewing', 'in progress' => 'warning',
            'saved' => 'info',
            'rejected' => 'danger',
            default => 'secondary',
        };
    }
}
