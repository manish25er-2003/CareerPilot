<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $profile = $user->profile()->first();
        $resumesCount = $user->resumes()->count();
        $applicationsCount = $user->jobApplications()->count();
        $interviewsCount = $user->interviewSessions()->count();
        $averageInterviewScore = (int) round(
            $user->interviewSessions()->where('total_score', '>', 0)->avg('total_score') ?? 0
        );

        $recentApplications = $user->jobApplications()
            ->latest('applied_at')
            ->limit(5)
            ->get();

        $recentAnalyses = $user->aiAnalyses()
            ->latest()
            ->limit(5)
            ->get();

        $upcomingInterviews = $user->jobApplications()
            ->whereNotNull('interview_date')
            ->where('interview_date', '>=', now())
            ->orderBy('interview_date')
            ->limit(3)
            ->get();

        $statusCounts = [
            'Saved' => $user->jobApplications()->where('status', 'Saved')->count(),
            'Applied' => $user->jobApplications()->where('status', 'Applied')->count(),
            'Shortlisted' => $user->jobApplications()->where('status', 'Shortlisted')->count(),
            'Interviewing' => $user->jobApplications()->where('status', 'Interviewing')->count(),
            'Offered' => $user->jobApplications()->where('status', 'Offered')->count(),
            'Rejected' => $user->jobApplications()->where('status', 'Rejected')->count(),
        ];

        $monthlyActivity = collect(range(1, 12))->map(function ($month) use ($user) {
            $count = $user->jobApplications()->whereMonth('created_at', $month)->count();

            return [
                'month' => now()->month($month)->translatedFormat('M'),
                'count' => $count,
            ];
        });

        return view('dashboard', compact(
            'user',
            'profile',
            'resumesCount',
            'applicationsCount',
            'interviewsCount',
            'averageInterviewScore',
            'recentApplications',
            'recentAnalyses',
            'upcomingInterviews',
            'statusCounts',
            'monthlyActivity'
        ));
    }
}
