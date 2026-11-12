<?php

namespace Database\Factories;

use App\Models\InterviewSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InterviewSession>
 */
class InterviewSessionFactory extends Factory
{
    protected $model = InterviewSession::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'role' => 'Laravel Developer',
            'difficulty' => 'Medium',
            'category' => 'Technical',
            'status' => 'completed',
            'total_score' => 82,
            'summary' => 'Demo interview session summary.',
        ];
    }
}
