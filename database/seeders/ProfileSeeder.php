<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@careerpilot.test')->first();
        if ($user) {
            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => 'Demo User',
                    'phone' => '+91 98765 43210',
                    'professional_headline' => 'Laravel Developer & Career Growth Specialist',
                    'location' => 'Bengaluru, India',
                    'education' => 'B.Tech in Computer Science',
                    'experience_years' => 3,
                    'bio' => 'Full-stack Laravel developer with strong experience in PHP, MySQL, and API-driven product work.',
                    'linkedin_url' => 'https://www.linkedin.com/in/demouser',
                    'github_url' => 'https://github.com/demouser',
                    'portfolio_url' => 'https://demouser.dev',
                    'profile_score' => 88,
                ]
            );
        }

        $admin = User::where('email', 'admin@careerpilot.test')->first();
        if ($admin) {
            Profile::updateOrCreate(
                ['user_id' => $admin->id],
                [
                    'full_name' => 'Demo Admin',
                    'phone' => '+91 90000 11111',
                    'professional_headline' => 'Platform Administrator',
                    'location' => 'Hyderabad, India',
                    'education' => 'MCA',
                    'experience_years' => 6,
                    'bio' => 'Platform administrator managing user onboarding, skills catalog, and product activity.',
                    'linkedin_url' => 'https://www.linkedin.com/in/demoadmin',
                    'github_url' => 'https://github.com/demoadmin',
                    'portfolio_url' => 'https://admin-demo.example.com',
                    'profile_score' => 90,
                ]
            );
        }
    }
}
