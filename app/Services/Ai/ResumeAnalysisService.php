<?php

namespace App\Services\Ai;

use Illuminate\Support\Facades\Http;

class ResumeAnalysisService
{
    public function analyze(string $resumeText, string $jobDescription, ?string $jobTitle = null): array
    {
        $apiKey = config('services.gemini.key');

        if ($apiKey) {
            try {
                $response = Http::timeout(30)->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey, [
                    'contents' => [[
                        'parts' => [[
                            'text' => $this->buildPrompt($resumeText, $jobDescription, $jobTitle),
                        ]],
                    ]],
                    'generationConfig' => [
                        'temperature' => 0.2,
                    ],
                ]);

                if ($response->successful()) {
                    $payload = $response->json();
                    $content = data_get($payload, 'candidates.0.content.parts.0.text');

                    if ($content) {
                        return $this->parseAiResponse($content);
                    }
                }
            } catch (\Throwable $e) {
                // Fall back to local heuristics below.
            }
        }

        return $this->fallbackAnalysis($resumeText, $jobDescription, $jobTitle);
    }

    protected function buildPrompt(string $resumeText, string $jobDescription, ?string $jobTitle): string
    {
        return "You are an expert ATS and career coach. Analyze the resume against this job description and return JSON with keys: overall_score, match_percentage, strengths, weaknesses, missing_skills, recommended_skills, ats_suggestions, summary. Use integer score values between 0 and 100. Format as valid JSON only.\n\nJob title: " . ($jobTitle ?? 'Not specified') . "\n\nJob description:\n" . $jobDescription . "\n\nResume:\n" . $resumeText;
    }

    protected function parseAiResponse(string $content): array
    {
        $json = $this->extractJson($content);

        if (! is_array($json)) {
            return $this->fallbackAnalysis('', '');
        }

        return [
            'overall_score' => (int) data_get($json, 'overall_score', 80),
            'match_percentage' => (int) data_get($json, 'match_percentage', 80),
            'strengths' => array_values((array) data_get($json, 'strengths', [])),
            'weaknesses' => array_values((array) data_get($json, 'weaknesses', [])),
            'missing_skills' => array_values((array) data_get($json, 'missing_skills', [])),
            'recommended_skills' => array_values((array) data_get($json, 'recommended_skills', [])),
            'ats_suggestions' => array_values((array) data_get($json, 'ats_suggestions', [])),
            'summary' => (string) data_get($json, 'summary', 'Resume reviewed successfully.'),
        ];
    }

    protected function extractJson(string $content): ?array
    {
        $start = strpos($content, '{');
        $end = strrpos($content, '}');

        if ($start === false || $end === false || $end < $start) {
            return null;
        }

        $json = substr($content, $start, $end - $start + 1);

        $decoded = json_decode($json, true);

        return is_array($decoded) ? $decoded : null;
    }

    protected function fallbackAnalysis(string $resumeText, string $jobDescription, ?string $jobTitle = null): array
    {
        $resumeWords = $this->tokenize($resumeText);
        $jobWords = $this->tokenize($jobDescription);
        $common = array_values(array_unique(array_intersect($resumeWords, $jobWords)));
        $missing = array_values(array_diff(array_slice($jobWords, 0, 8), $resumeWords));

        $match = min(100, max(40, (int) round((count($common) / max(1, count($jobWords))) * 100)));

        return [
            'overall_score' => min(100, max(55, $match + 10)),
            'match_percentage' => $match,
            'strengths' => [
                'Strong role alignment with the targeted job profile.',
                'Solid communication and work experience evidence.',
                'Relevant professional experience is visible.',
            ],
            'weaknesses' => [
                'Add more job-specific keywords and measurable outcomes.',
                'Increase detail in technical projects and impact statements.',
                'Clarify certifications or advanced skills linked to the role.',
            ],
            'missing_skills' => $missing ?: ['React', 'SQL', 'System design', 'Communication'],
            'recommended_skills' => ['Problem solving', 'System design', 'Stakeholder communication', 'Cloud fundamentals'],
            'ats_suggestions' => [
                'Add direct keywords from the job description.',
                'Use standard section headings such as Experience, Skills, Education, Projects.',
                'Quantify achievements with metrics and results.',
            ],
            'summary' => 'The resume has a strong base for the role, but it needs deeper alignment with the target job description and more measurable impact. ',
        ];
    }

    protected function tokenize(string $text): array
    {
        $text = strtolower(preg_replace('/[^a-z0-9\s]/', ' ', $text) ?? $text);
        $words = preg_split('/\s+/', trim($text));

        $filtered = [];
        foreach ($words ?? [] as $word) {
            if (strlen($word) < 3 || in_array($word, ['the', 'and', 'with', 'your', 'this', 'that', 'have', 'from', 'into', 'will', 'over'], true)) {
                continue;
            }
            $filtered[] = $word;
        }

        return array_values(array_unique($filtered));
    }
}
