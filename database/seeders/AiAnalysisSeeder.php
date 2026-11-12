<?php

namespace Database\Seeders;

use App\Models\AiAnalysis;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Seeder;

class AiAnalysisSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@careerpilot.test')->first();
        $resume = Resume::where('user_id', $user?->id ?? 0)->first();

        if (! $user || ! $resume) {
            return;
        }

        AiAnalysis::updateOrCreate(
            ['user_id' => $user->id, 'resume_id' => $resume->id],
            [
                'job_title' => 'Senior Laravel Developer',
                'job_description' => 'Build API-driven backend systems, write clean Laravel code, and collaborate across product and engineering teams.',
                'overall_score' => 89,
                'match_percentage' => 87,
                'strengths' => ['Strong Laravel experience', 'Good API design awareness', 'Solid database knowledge'],
                'weaknesses' => ['Add more measurable outcomes', 'Increase focus on system design patterns'],
                'missing_skills' => ['Distributed systems', 'Queue management'],
                'recommended_skills' => ['System design', 'Redis', 'Testing strategy'],
                'ats_suggestions' => ['Use direct role keywords', 'Highlight business impact metrics'],
                'summary' => 'Demo AI analysis result for a Laravel developer role. This record is explicit sample data for demonstration purposes.',
                'status' => 'demo',
            ]
        );
    }
}
