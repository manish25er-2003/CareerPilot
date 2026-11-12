<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'full_name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'professional_headline' => 'Laravel developer focused on product delivery',
            'location' => fake()->city() . ', India',
            'education' => 'B.Tech in Computer Science',
            'experience_years' => 3,
            'bio' => fake()->paragraph(),
            'linkedin_url' => 'https://linkedin.com/in/' . fake()->userName(),
            'github_url' => 'https://github.com/' . fake()->userName(),
            'portfolio_url' => 'https://portfolio.example.com/' . fake()->userName(),
            'profile_score' => 82,
        ];
    }
}
