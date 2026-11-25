<?php

namespace App\Http\Controllers;

use App\Http\Resources\AiAnalysisResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiDashboardController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $latestAnalysis = $user->aiAnalyses()->latest()->first();

        return response()->json([
            'profile_completion' => $user->profile?->profile_score ?? 0,
            'total_resumes' => $user->resumes()->count(),
            'total_applications' => $user->jobApplications()->count(),
            'interviews_completed' => $user->interviewSessions()->count(),
            'average_interview_score' => (int) round($user->interviewSessions()->avg('total_score') ?? 0),
            'latest_resume_analysis' => $latestAnalysis
                ? (new AiAnalysisResource($latestAnalysis))->toArray($request)
                : null,
        ]);
    }
}
