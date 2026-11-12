<?php

namespace App\Http\Controllers;

use App\Http\Requests\AiAnalysisRequest;
use App\Models\AiAnalysis;
use App\Models\Resume;
use App\Services\Ai\ResumeAnalysisService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
        $text = file_get_contents(storage_path('app/' . $resume->file_path));
        $text = $this->extractTextFromFile($text, $resume->mime_type);

        $result = $analysisService->analyze($text, $request->input('job_description'), $request->input('job_title'));

        $analysis = Auth::user()->aiAnalyses()->create([
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
            'status' => 'completed',
        ]);

        return redirect()->route('ai-analysis.index')->with('success', 'Resume analysis completed successfully.');
    }

    protected function extractTextFromFile(string $fileContents, ?string $mimeType): string
    {
        $mimeType = strtolower((string) $mimeType);

        if (str_contains($mimeType, 'pdf')) {
            return $this->extractPdfText($fileContents);
        }

        if (str_contains($mimeType, 'word') || str_contains($mimeType, 'officedocument')) {
            return $this->extractDocxText($fileContents);
        }

        $text = preg_replace('/\s+/', ' ', strip_tags($fileContents)) ?? $fileContents;

        return trim($text) ?: 'Resume content was not parsed automatically. Please add a stronger description and target keywords.';
    }

    protected function extractPdfText(string $content): string
    {
        preg_match_all('/\((?:\\\\.|[^()\\\\])*\)/', $content, $matches);

        if (! empty($matches[0])) {
            $text = implode(' ', $matches[0]);
            $text = str_replace(['\\(', '\\)', '\\\\'], ['(', ')', '\\'], $text);
            $text = preg_replace('/\s+/', ' ', $text) ?? $text;

            if (trim($text) !== '') {
                return trim($text);
            }
        }

        $plainText = preg_replace('/\s+/', ' ', $content) ?? $content;

        return trim($plainText) !== '' ? trim($plainText) : 'Resume content could not be extracted automatically.';
    }

    protected function extractDocxText(string $content): string
    {
        $temporaryFile = tempnam(sys_get_temp_dir(), 'careerpilot-docx-');

        if ($temporaryFile === false) {
            return 'Document resume content was not parsed automatically.';
        }

        file_put_contents($temporaryFile, $content);

        $zip = new \ZipArchive();
        $opened = $zip->open($temporaryFile);

        if ($opened !== true) {
            unlink($temporaryFile);

            return 'Document resume content was not parsed automatically.';
        }

        $xml = $zip->getFromName('word/document.xml');
        $zip->close();
        unlink($temporaryFile);

        if (! is_string($xml) || trim($xml) === '') {
            return 'Document resume content was not parsed automatically.';
        }

        $text = preg_replace('/<[^>]+>/', ' ', $xml) ?? $xml;
        $text = html_entity_decode(strip_tags($text));
        $text = preg_replace('/\s+/', ' ', $text) ?? $text;

        return trim($text) ?: 'Document resume content was not parsed automatically.';
    }
}
