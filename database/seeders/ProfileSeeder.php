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
                    'full_name' => 'Rayden Carter',
                    'phone' => '+91 98765 43210',
                    'professional_headline' => 'Product Designer & Career Growth Specialist',
                    'location' => 'Bengaluru, India',
                    'education' => 'B.Design in Interaction Design',
                    'experience_years' => 4,
                    'bio' => 'Design-minded product professional focused on user experience, portfolio storytelling, and career momentum.',
                    'linkedin_url' => 'https://www.linkedin.com/in/rayden',
                    'github_url' => 'https://github.com/rayden',
                    'portfolio_url' => 'https://rayden.design',
                    'profile_score' => 85,
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
