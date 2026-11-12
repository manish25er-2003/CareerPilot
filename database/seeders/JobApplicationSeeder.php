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
                'company_name' => 'Google',
                'job_title' => 'UI/UX Designer',
                'job_url' => 'https://example.com/jobs/google-ux',
                'location' => 'Bengaluru',
                'salary_range' => '₹24 LPA',
                'job_type' => 'Full-time',
                'status' => 'Accepted',
                'applied_at' => now()->subDays(2),
                'interview_date' => now()->addDays(6),
                'notes' => 'Status updated after the final portfolio review.',
            ],
            [
                'company_name' => 'Gojek',
                'job_title' => 'Product Designer',
                'job_url' => 'https://example.com/jobs/gojek-product',
                'location' => 'Jakarta',
                'salary_range' => '₹22 LPA',
                'job_type' => 'Full-time',
                'status' => 'Accepted',
                'applied_at' => now()->subDays(4),
                'interview_date' => now()->addDays(10),
                'notes' => 'Strong match with the design system role.',
            ],
            [
                'company_name' => 'Traveloka',
                'job_title' => 'UI Designer',
                'job_url' => 'https://example.com/jobs/traveloka-ui',
                'location' => 'Bandung',
                'salary_range' => '₹18 LPA',
                'job_type' => 'Full-time',
                'status' => 'Interviewing',
                'applied_at' => now()->subDays(11),
                'interview_date' => now()->addDays(2),
                'notes' => 'Panel interview scheduled for next week.',
            ],
            [
                'company_name' => 'Shopee Indonesia',
                'job_title' => 'Web Designer',
                'job_url' => 'https://example.com/jobs/shopee-web',
                'location' => 'Jakarta',
                'salary_range' => '₹19 LPA',
                'job_type' => 'Full-time',
                'status' => 'Accepted',
                'applied_at' => now()->subDays(15),
                'interview_date' => now()->addDays(4),
                'notes' => 'Portfolio passed the first screening call.',
            ],
            [
                'company_name' => 'Agoda',
                'job_title' => 'Motion Designer',
                'job_url' => 'https://example.com/jobs/agoda-motion',
                'location' => 'Singapore',
                'salary_range' => '₹20 LPA',
                'job_type' => 'Full-time',
                'status' => 'In Progress',
                'applied_at' => now()->subDays(18),
                'interview_date' => now()->addDays(7),
                'notes' => 'Following up for a design challenge review.',
            ],
            [
                'company_name' => 'Tokopedia',
                'job_title' => 'UX Researcher',
                'job_url' => 'https://example.com/jobs/tokopedia-ux',
                'location' => 'Tangerang',
                'salary_range' => '₹17 LPA',
                'job_type' => 'Full-time',
                'status' => 'Rejected',
                'applied_at' => now()->subDays(22),
                'interview_date' => null,
                'notes' => 'The recruiter shared a polite rejection after screening.',
            ],
            [
                'company_name' => 'Grab',
                'job_title' => 'Visual Designer',
                'job_url' => 'https://example.com/jobs/grab-visual',
                'location' => 'Jakarta',
                'salary_range' => '₹18 LPA',
                'job_type' => 'Full-time',
                'status' => 'Saved',
                'applied_at' => now()->subDays(9),
                'interview_date' => null,
                'notes' => 'Saved for a future application cycle.',
            ],
            [
                'company_name' => 'Spotify',
                'job_title' => 'Interaction Designer',
                'job_url' => 'https://example.com/jobs/spotify-ixd',
                'location' => 'Remote',
                'salary_range' => '₹26 LPA',
                'job_type' => 'Remote',
                'status' => 'Applied',
                'applied_at' => now()->subDays(13),
                'interview_date' => now()->addDays(5),
                'notes' => 'Waiting on asynchronous portfolio review.',
            ],
            [
                'company_name' => 'Notion',
                'job_title' => 'Senior Product Designer',
                'job_url' => 'https://example.com/jobs/notion-pd',
                'location' => 'Remote',
                'salary_range' => '₹28 LPA',
                'job_type' => 'Remote',
                'status' => 'Interviewing',
                'applied_at' => now()->subDays(25),
                'interview_date' => now()->addDays(1),
                'notes' => 'Portfolio case study review is next.',
            ],
            [
                'company_name' => 'Figma',
                'job_title' => 'Design Systems Engineer',
                'job_url' => 'https://example.com/jobs/figma-dse',
                'location' => 'Remote',
                'salary_range' => '₹27 LPA',
                'job_type' => 'Remote',
                'status' => 'Applied',
                'applied_at' => now()->subDays(30),
                'interview_date' => null,
                'notes' => 'Still waiting on a response from the recruiter.',
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
