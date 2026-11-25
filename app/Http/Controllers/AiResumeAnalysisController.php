<?php

namespace App\Http\Controllers;

use App\Http\Requests\AiAnalysisRequest;
use App\Services\Ai\ResumeAnalysisService;
use App\Services\Ai\ResumeTextExtractionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AiResumeAnalysisController extends Controller
{
    public function index(): View
    {
        $analyses = Auth::user()->aiAnalyses()->latest()->get();
        $resumes = Auth::user()->resumes()->latest()->get();

        return view('ai.index', compact('analyses', 'resumes'));
    }

    public function store(AiAnalysisRequest $request, ResumeAnalysisService $analysisService): RedirectResponse
    {
        $resume = Auth::user()->resumes()->findOrFail($request->input('resume_id'));
        try {
            $text = $analysisService->extractResumeText($resume);
        } catch (ResumeTextExtractionException $exception) {
            throw ValidationException::withMessages(['resume_id' => $exception->getMessage()]);
        }

        $result = $analysisService->analyze(
            $text,
            $request->input('job_description'),
            $request->input('job_title')
        );

        Auth::user()->aiAnalyses()->create([
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
            'status' => 'completed',
        ]);

        return redirect()->route('ai-analysis.index')->with('success', 'Resume analysis completed successfully.');
    }
}
