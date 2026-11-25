<?php

namespace Tests\Feature;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApiLifecycleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_login_via_api(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'API Tester',
            'email' => 'api@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['user', 'token']);

        $loginResponse = $this->postJson('/api/login', [
            'email' => 'api@example.com',
            'password' => 'password123',
        ]);

        $loginResponse->assertOk()
            ->assertJsonStructure(['user', 'token']);
    }

    public function test_api_login_returns_a_json_error_for_invalid_credentials(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'unknown@example.com',
            'password' => 'incorrect-password',
        ]);

        $response->assertUnauthorized()
            ->assertJsonPath('message', 'The email or password you entered is incorrect. Please try again.');
    }

    public function test_authenticated_user_can_fetch_dashboard_via_api(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/dashboard');

        $response->assertOk()
            ->assertJsonPath('total_resumes', 0)
            ->assertJsonPath('total_applications', 0);
    }

    public function test_resume_analysis_api_returns_result_for_uploaded_resume(): void
    {
        Storage::fake('local');
        config(['services.gemini.key' => null]);

        $user = User::factory()->create();
        $resume = Resume::create([
            'user_id' => $user->id,
            'title' => 'API Resume',
            'file_path' => 'resumes/'.$user->id.'/resume.txt',
            'original_name' => 'resume.txt',
            'mime_type' => 'text/plain',
            'size' => 120,
            'is_primary' => true,
        ]);

        Storage::disk('local')->put($resume->file_path, 'Senior software engineer with React, Laravel, and SQL experience. Built analytics tools and shipped production features.');

        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/ai/resume-analysis', [
                'resume_id' => $resume->id,
                'job_title' => 'Senior Full Stack Engineer',
                'job_description' => 'Need Laravel, React, SQL, API design, and product ownership experience.',
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'data' => ['job_title', 'summary', 'overall_score']]);
    }
}
