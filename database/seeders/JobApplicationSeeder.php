<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@careerpilot.test')->first();

        if (! $user) {
            return;
        }

        $jobs = [
            [
                'company_name' => 'TCS',
                'job_title' => 'Laravel Developer',
                'job_url' => 'https://example.com/jobs/tcs-laravel',
                'location' => 'Bengaluru',
                'salary_range' => '₹12 LPA',
                'job_type' => 'Full-time',
                'status' => 'Applied',
                'applied_at' => now()->subDays(12),
                'interview_date' => now()->addDays(4),
                'notes' => 'Application submitted through company careers portal.',
            ],
            [
                'company_name' => 'Infosys',
                'job_title' => 'Backend Engineer',
                'job_url' => 'https://example.com/jobs/infosys-backend',
                'location' => 'Pune',
                'salary_range' => '₹14 LPA',
                'job_type' => 'Full-time',
                'status' => 'Shortlisted',
                'applied_at' => now()->subDays(25),
                'interview_date' => now()->addDays(8),
                'notes' => 'Pending technical interview scheduling.',
            ],
            [
                'company_name' => 'Wipro',
                'job_title' => 'PHP Developer',
                'job_url' => 'https://example.com/jobs/wipro-php',
                'location' => 'Hyderabad',
                'salary_range' => '₹10 LPA',
                'job_type' => 'Full-time',
                'status' => 'Saved',
                'applied_at' => now()->subDays(40),
                'interview_date' => null,
                'notes' => 'Saved for future follow-up.',
            ],
        ];

        foreach ($jobs as $job) {
            JobApplication::updateOrCreate(
                ['user_id' => $user->id, 'company_name' => $job['company_name'], 'job_title' => $job['job_title']],
                $job + ['user_id' => $user->id]
            );
        }
    }
}
