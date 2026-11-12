<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiReportController extends Controller
{
    public function overview(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'applications' => $user->jobApplications()->count(),
            'interviews' => $user->interviewSessions()->count(),
            'resumes' => $user->resumes()->count(),
            'average_score' => (int) round($user->interviewSessions()->avg('total_score') ?? 0),
            'status_breakdown' => $user->jobApplications()->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status'),
        ]);
    }
}
