<?php

namespace Database\Seeders;

use App\Models\InterviewAnswer;
use App\Models\InterviewQuestion;
use App\Models\InterviewSession;
use App\Models\User;
use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@careerpilot.test')->first();

        if (! $user) {
            return;
        }

        $session = InterviewSession::updateOrCreate(
            ['user_id' => $user->id, 'role' => 'Laravel Developer'],
            [
                'difficulty' => 'Medium',
                'category' => 'Technical',
                'status' => 'completed',
                'total_score' => 84,
                'summary' => 'Demo Laravel developer mock interview summary.',
            ]
        );

        $question1 = InterviewQuestion::updateOrCreate(
            ['interview_session_id' => $session->id, 'question' => 'How do you optimize a slow Laravel query?'],
            [
                'difficulty' => 'Medium',
                'category' => 'PHP',
            ]
        );

        InterviewAnswer::updateOrCreate(
            ['interview_question_id' => $question1->id],
            [
                'answer_text' => 'I would inspect the query explain plan, add indexes, remove redundant eager loading, and use database constraints and caching where needed.',
                'score' => 86,
                'feedback' => 'Strong technical reasoning and practical optimization approach.',
                'strengths' => ['Clear debugging approach', 'Strong database awareness'],
                'weaknesses' => ['Could mention query caching and load testing'],
                'suggested_answer' => 'Explain query analysis, indexing, eager loading, and caching trade-offs.',
            ]
        );

        $question2 = InterviewQuestion::updateOrCreate(
            ['interview_session_id' => $session->id, 'question' => 'What is the difference between eager loading and lazy loading in Laravel?'],
            [
                'difficulty' => 'Easy',
                'category' => 'Database',
            ]
        );

        InterviewAnswer::updateOrCreate(
            ['interview_question_id' => $question2->id],
            [
                'answer_text' => 'Eager loading loads related models in advance to reduce N+1 queries, while lazy loading resolves them later when accessed.',
                'score' => 88,
                'feedback' => 'Good explanation and accurate comparison.',
                'strengths' => ['Core Laravel knowledge', 'Correct concept recall'],
                'weaknesses' => ['Could include a practical example'],
                'suggested_answer' => 'Describe N+1 query impact and explain the performance trade-off between eager and lazy loading.',
            ]
        );
    }
}
