<?php

namespace Tests\Feature;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModulesTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_page_is_accessible(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk();
    }

    public function test_dashboard_page_handles_string_dates_in_job_applications(): void
    {
        $user = User::factory()->create();

        JobApplication::create([
            'user_id' => $user->id,
            'company_name' => 'CareerPilot Labs',
            'job_title' => 'Product Designer',
            'job_url' => 'https://example.com/jobs/design',
            'location' => 'Remote',
            'salary_range' => '₹18 LPA',
            'job_type' => 'Full-time',
            'status' => 'Applied',
            'applied_at' => '2026-10-15',
            'interview_date' => '2026-10-20 14:30:00',
            'notes' => 'Demo application for dashboard regression test.',
        ]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk();
    }

    public function test_skills_page_is_accessible(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/skills')
            ->assertOk();
    }

    public function test_jobs_page_is_accessible(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/jobs')
            ->assertOk();
    }
}
