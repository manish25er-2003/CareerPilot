<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiDashboardController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'profile_completion' => $user->profile?->profile_score ?? 0,
            'total_resumes' => $user->resumes()->count(),
            'total_applications' => $user->jobApplications()->count(),
            'interviews_completed' => $user->interviewSessions()->count(),
            'average_interview_score' => (int) round($user->interviewSessions()->avg('total_score') ?? 0),
        ]);
    }
}
