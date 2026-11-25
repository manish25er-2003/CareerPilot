<?php

namespace App\Http\Controllers;

use App\Http\Requests\AiAnalysisRequest;
use App\Http\Resources\AiAnalysisResource;
use App\Services\Ai\ResumeAnalysisService;
use App\Services\Ai\ResumeTextExtractionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiAiAnalysisController extends Controller
{
    public function resumeAnalysis(AiAnalysisRequest $request, ResumeAnalysisService $service): JsonResponse
    {
        $resume = $request->user()->resumes()->findOrFail($request->input('resume_id'));
        try {
            $resumeText = $service->extractResumeText($resume);
        } catch (ResumeTextExtractionException $exception) {
            throw ValidationException::withMessages(['resume_id' => $exception->getMessage()]);
        }

        $result = $service->analyze($resumeText, $request->input('job_description'), $request->input('job_title'));

        $analysis = $request->user()->aiAnalyses()->create([
            'resume_id' => $resume->id,
            'job_title' => $request->input('job_title'),
            'job_description' => $request->input('job_description'),
            'overall_score' => $result['overall_score'],
            'match_percentage' => $result['match_percentage'],
            'strengths' => $result['strengths'],
            'weaknesses' => $result['weaknesses'],
            'missing_skills' => $result['missing_skills'],
            'recommended_skills' => $result['recommended_skills'],
            'ats_suggestions' => $result['ats_suggestions'],
            'summary' => $result['summary'],
            'structured_profile' => $result['profile'],
            'role_recommendations' => $result['role_recommendations'],
            'matched_skills' => $result['matched_skills'],
            'skill_gaps' => $result['skill_gaps'],
            'career_roadmap' => $result['career_roadmap'],
            'learning_recommendations' => $result['learning_recommendations'],
            'analysis_source' => $result['analysis_source'],
        ]);

        return response()->json(['message' => 'Resume analyzed', 'data' => new AiAnalysisResource($analysis)], 201);
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json(['data' => AiAnalysisResource::collection($request->user()->aiAnalyses()->latest()->get())]);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $analysis = $request->user()->aiAnalyses()->findOrFail($id);

        return response()->json(['data' => new AiAnalysisResource($analysis)]);
    }
}
