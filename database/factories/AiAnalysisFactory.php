<?php

namespace Database\Factories;

use App\Models\AiAnalysis;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AiAnalysis>
 */
class AiAnalysisFactory extends Factory
{
    protected $model = AiAnalysis::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'resume_id' => Resume::factory(),
            'job_title' => 'Senior Laravel Developer',
            'job_description' => 'Build PHP and Laravel APIs, optimize database performance, and collaborate with frontend teams.',
            'overall_score' => 88,
            'match_percentage' => 86,
            'strengths' => ['Laravel backend experience', 'Database design knowledge', 'API development'],
            'weaknesses' => ['Add more measurable business impact', 'Improve system design examples'],
            'missing_skills' => ['Redis', 'Queue orchestration', 'Microservices patterns'],
            'recommended_skills' => ['System design', 'Queues', 'Testing strategy'],
            'ats_suggestions' => ['Add role-specific keywords', 'Use standard section headings'],
            'summary' => 'Demo AI analysis result for interview preparation.',
            'status' => 'completed',
        ];
    }
}
