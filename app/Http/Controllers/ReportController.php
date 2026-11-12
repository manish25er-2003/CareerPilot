<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function overview(): View
    {
        $user = Auth::user();

        $totals = [
            'applications' => $user->jobApplications()->count(),
            'interviews' => $user->interviewSessions()->count(),
            'resumes' => $user->resumes()->count(),
            'analyses' => $user->aiAnalyses()->count(),
        ];

        $statusBreakdown = $user->jobApplications()->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        $averageScore = (int) round($user->interviewSessions()->avg('total_score') ?? 0);

        return view('reports.overview', compact('totals', 'statusBreakdown', 'averageScore'));
    }
}
