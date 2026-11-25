<?php

namespace Tests\Feature;

use App\Models\AiAnalysis;
use App\Models\InterviewSession;
use App\Models\JobApplication;
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
            ->assertSee('Manish Kumar')
            ->assertSee('View My Portfolio')
            ->assertSee('Professional Details')
            ->assertSee('1+ Year')
            ->assertSee('Meet the Developer');
    }

    public function test_homepage_activity_shows_real_records_and_profile_image(): void
    {
        $admin = User::factory()->create([
            'name' => 'Rohit Kumar',
            'email' => 'rohit@example.com',
            'role' => 'admin',
        ]);
        $admin->profile()->create([
            'profile_image' => 'https://images.example.com/rohit.jpg',
        ]);

        Resume::factory()->create([
            'user_id' => $admin->id,
            'title' => 'Product Designer Resume',
        ]);
        JobApplication::factory()->create([
            'user_id' => $admin->id,
            'company_name' => 'Northstar Studio',
            'job_title' => 'Product Designer',
            'status' => 'Interviewing',
        ]);

        $this->actingAs($admin)
            ->get('/')
            ->assertOk()
            ->assertSee('Rohit Kumar')
            ->assertSee('rohit@example.com')
            ->assertSee('https://images.example.com/rohit.jpg')
            ->assertSee('Product Designer Resume')
            ->assertSee('Northstar Studio')
            ->assertSee('Product Designer')
            ->assertSee('Interviewing')
            ->assertSee('View All Users')
            ->assertSee('View Resumes')
            ->assertSee('View Applications');
    }

    public function test_homepage_activity_shows_empty_states_when_no_records_exist(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('No recent members yet')
            ->assertSee('No recent resume activity yet')
            ->assertSee('No recent application activity yet')
            ->assertSee('No registered members yet')
            ->assertSee('Your Career Growth at a Glance')
            ->assertSee('Sign in to view your progress')
            ->assertSee('Go to Profile')
            ->assertSee('Analyze Resume')
            ->assertSee('Browse Jobs');
    }

    public function test_homepage_live_activity_uses_real_member_percentages(): void
    {
        $users = User::factory()->count(4)->create();

        Resume::factory()->create(['user_id' => $users[0]->id]);
        Resume::factory()->create(['user_id' => $users[1]->id]);
        JobApplication::factory()->create(['user_id' => $users[0]->id]);
        InterviewSession::factory()->count(3)->create([
            'user_id' => $users[0]->id,
        ]);
        InterviewSession::factory()->create(['user_id' => $users[1]->id]);
        InterviewSession::factory()->create(['user_id' => $users[2]->id]);

        AiAnalysis::factory()->create([
            'user_id' => $users[0]->id,
            'resume_id' => null,
            'status' => 'completed',
        ]);
        AiAnalysis::factory()->create([
            'user_id' => $users[1]->id,
            'resume_id' => null,
            'status' => 'completed',
        ]);
        AiAnalysis::factory()->create([
            'user_id' => $users[2]->id,
            'resume_id' => null,
            'status' => 'processing',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSeeInOrder([
                'Live Platform Activity',
                'Resume Completion',
                '50%',
                '2 of 4 members',
                'Applications',
                '25%',
                '1 of 4 members',
                'Interview Practice',
                '75%',
                '3 of 4 members',
                'AI Analysis',
                '50%',
                '2 of 4 members',
            ]);
    }

    public function test_homepage_growth_glance_uses_authenticated_user_metrics(): void
    {
        $user = User::factory()->create();

        JobApplication::factory()->count(3)->create(['user_id' => $user->id]);
        InterviewSession::factory()->count(2)->create(['user_id' => $user->id]);

        $firstAnalysis = AiAnalysis::factory()->create([
            'user_id' => $user->id,
            'resume_id' => null,
            'overall_score' => 64,
            'match_percentage' => 72,
        ]);
        $firstAnalysis->created_at = now()->subDays(10);
        $firstAnalysis->saveQuietly();

        AiAnalysis::factory()->create([
            'user_id' => $user->id,
            'resume_id' => null,
            'overall_score' => 81,
            'match_percentage' => 88,
        ]);

        $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSee('Your Career Growth at a Glance')
            ->assertSeeInOrder([
                '3',
                'Total Applications',
                '2',
                'Interviews',
                '88%',
                'Job Match Score',
                '+17 pts',
                'Career Growth',
            ]);
    }

    public function test_homepage_growth_glance_shows_empty_analysis_metrics_for_a_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSee('Analyze a resume to see your score')
            ->assertSee('Complete 2 analyses to track change');
    }

    public function test_homepage_job_search_features_show_the_three_feature_cards(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSeeInOrder([
                'Key Features',
                'Fuel your next step in your',
                'career',
                'Learn',
                'Build',
                'Get Hired',
            ]);

        $this->assertSame(
            3,
            substr_count($response->getContent(), 'class="job-feature-card job-feature-card--'),
        );
    }

    public function test_homepage_profile_intelligence_displays_saved_role_recommendations(): void
    {
        $user = User::factory()->create();
        AiAnalysis::factory()->create([
            'user_id' => $user->id,
            'resume_id' => null,
            'role_recommendations' => [
                [
                    'role_title' => 'Product Designer',
                    'match_percentage' => 87,
                    'explanation' => 'Your product and research experience align with this role.',
                ],
                [
                    'role_title' => 'UX Researcher',
                    'match_percentage' => 72,
                    'explanation' => 'Your user research skills support this role.',
                ],
            ],
        ]);

        $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSeeInOrder([
                'Profile Intelligence',
                'Your Matches',
                'Product Designer',
                '87% Match',
                'UX Researcher',
                '72% Match',
            ])
            ->assertSee(route('jobs.index', ['job_title' => 'Product Designer']), false);
    }

    public function test_homepage_profile_intelligence_prompts_for_analysis_without_recommendations(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSee('Your matches will appear here')
            ->assertSee('Analyze Resume');
    }

    public function test_homepage_career_momentum_preview_keeps_its_dashboard_content_visible(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSeeInOrder([
                'Keep the momentum',
                'Build momentum with consistent, smarter',
                'career growth.',
                'Career workspace preview',
                'Resume readiness',
                'Product Analyst',
                'Frontend Engineer',
                'Interview prep',
            ]);
    }
}
