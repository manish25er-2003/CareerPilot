<?php

namespace Tests\Feature;

use App\Models\AiAnalysis;
use App\Models\InterviewSession;
use App\Models\JobApplication;
use App\Models\Profile;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserModulesTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_page_uses_authenticated_user_identity(): void
    {
        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Jane Doe')
            ->assertSee('jane@example.com');
    }

    public function test_user_can_update_profile_image(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        $this->actingAs($user)
            ->patch('/profile', [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'profile_image' => UploadedFile::fake()->image('avatar.jpg', 300, 300),
            ])
            ->assertRedirect('/profile');

        $this->assertCount(1, Storage::disk('public')->allFiles('profile-images'));
    }

    public function test_dashboard_shows_database_based_counts_for_user_records(): void
    {
        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        JobApplication::factory()->count(2)->create([
            'user_id' => $user->id,
            'status' => 'Applied',
        ]);
        Resume::factory()->count(1)->create(['user_id' => $user->id]);
        InterviewSession::factory()->count(1)->create([
            'user_id' => $user->id,
            'status' => 'completed',
            'total_score' => 90,
        ]);
        AiAnalysis::factory()->count(1)->create([
            'user_id' => $user->id,
            'overall_score' => 82,
        ]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSeeInOrder(['Total Applications Sent', '2']);
    }

    public function test_admin_dashboard_shows_application_wide_statistics(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin@example.com']);
        $user = User::factory()->create(['role' => 'user', 'email' => 'user@example.com']);

        JobApplication::factory()->count(3)->create(['user_id' => $user->id]);
        Resume::factory()->count(2)->create(['user_id' => $user->id]);
        InterviewSession::factory()->count(1)->create(['user_id' => $user->id]);
        AiAnalysis::factory()->count(1)->create(['user_id' => $user->id]);

        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertSeeInOrder(['Total users', '3'])
            ->assertSeeInOrder(['Total resumes', '2']);
    }

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

    public function test_developer_page_and_footer_links_are_visible(): void
    {
        $this->get('/')->assertOk()->assertSee('Meet the Developer');

        $this->get('/developer')
            ->assertOk()
            ->assertSee('Manish Yadav')
            ->assertSee('View My Portfolio');
    }
}
