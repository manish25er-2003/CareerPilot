<?php

namespace Database\Factories;

use App\Models\InterviewQuestion;
use App\Models\InterviewSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InterviewQuestion>
 */
class InterviewQuestionFactory extends Factory
{
    protected $model = InterviewQuestion::class;

    public function definition(): array
    {
        return [
            'interview_session_id' => InterviewSession::factory(),
            'question' => 'Describe how you would optimize a slow Laravel query.',
            'difficulty' => 'Medium',
            'category' => 'Backend',
        ];
    }
}
