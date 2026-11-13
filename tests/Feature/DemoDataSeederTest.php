<?php

namespace Tests\Feature;

use App\Models\AiAnalysis;
use App\Models\JobApplication;
use App\Models\Profile;
use App\Models\Resume;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemoDataSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_seeders_create_realistic_dashboard_data(): void
    {
        $this->seed(UserSeeder::class);

        $this->assertGreaterThanOrEqual(6, User::where('role', 'user')->count());
        $this->assertGreaterThanOrEqual(6, Profile::count());
        $this->assertGreaterThanOrEqual(6, Resume::count());
        $this->assertGreaterThanOrEqual(15, JobApplication::count());
        $this->assertGreaterThanOrEqual(6, AiAnalysis::count());
    }
}
