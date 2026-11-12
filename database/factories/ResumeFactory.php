<?php

namespace Database\Factories;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resume>
 */
class ResumeFactory extends Factory
{
    protected $model = Resume::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => 'Demo Resume',
            'file_path' => 'resumes/demo/demo-resume.txt',
            'original_name' => 'demo-resume.txt',
            'mime_type' => 'text/plain',
            'size' => 1200,
            'is_primary' => false,
        ];
    }
}
