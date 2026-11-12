<?php

namespace Database\Factories;

use App\Models\InterviewAnswer;
use App\Models\InterviewQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InterviewAnswer>
 */
class InterviewAnswerFactory extends Factory
{
    protected $model = InterviewAnswer::class;

    public function definition(): array
    {
        return [
            'interview_question_id' => InterviewQuestion::factory(),
            'answer_text' => 'I would start by inspecting the query with EXPLAIN, add indexes, and reduce unnecessary eager loading.',
            'score' => 85,
            'feedback' => 'Strong technical reasoning and clear optimization strategy.',
            'strengths' => ['Root-cause thinking', 'Performance awareness'],
            'weaknesses' => ['Could mention caching and indexes more explicitly'],
            'suggested_answer' => 'Explain the query plan, identify bottlenecks, add indexes, and use caching where appropriate.',
        ];
    }
}
