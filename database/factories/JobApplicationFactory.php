<?php

namespace Database\Factories;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobApplication>
 */
class JobApplicationFactory extends Factory
{
    protected $model = JobApplication::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company_name' => fake()->company(),
            'job_title' => fake()->jobTitle(),
            'job_url' => fake()->url(),
            'location' => fake()->city() . ', India',
            'salary_range' => '₹' . fake()->numberBetween(10, 30) . ' LPA',
            'job_type' => fake()->randomElement(['Full-time', 'Contract', 'Internship']),
            'status' => fake()->randomElement(['Saved', 'Applied', 'Shortlisted', 'Interviewing', 'Offered', 'Rejected']),
            'applied_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'interview_date' => fake()->dateTimeBetween('+1 days', '+14 days'),
            'notes' => fake()->paragraph(),
        ];
    }
}
