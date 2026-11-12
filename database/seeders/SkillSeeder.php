<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'PHP', 'category' => 'Backend', 'description' => 'Core PHP programming and MVC architecture.'],
            ['name' => 'Laravel', 'category' => 'Backend', 'description' => 'Laravel application structure, routing, Eloquent, and service layer.'],
            ['name' => 'MySQL', 'category' => 'Database', 'description' => 'Schema design and SQL optimization.'],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'description' => 'DOM scripting and client-side interactivity.'],
            ['name' => 'HTML', 'category' => 'Frontend', 'description' => 'Semantic and accessible HTML.'],
            ['name' => 'CSS', 'category' => 'Frontend', 'description' => 'Responsive layout and design systems.'],
            ['name' => 'Git', 'category' => 'Backend', 'description' => 'Version control workflows and branching strategies.'],
        ];

        $profile = Profile::where('full_name', 'Demo User')->first();

        foreach ($skills as $skillData) {
            $skill = Skill::firstOrCreate(
                ['name' => $skillData['name'], 'category' => $skillData['category']],
                ['description' => $skillData['description']]
            );

            if ($profile) {
                $profile->skills()->syncWithoutDetaching([
                    $skill->id => ['proficiency_level' => 'Advanced'],
                ]);
            }
        }

        $demoUser = User::where('email', 'user@careerpilot.test')->first();
        if ($demoUser) {
            $demoProfile = $demoUser->profile()->first();
            if ($demoProfile) {
                $demoProfile->skills()->syncWithoutDetaching([
                    Skill::where('name', 'Laravel')->value('id') => ['proficiency_level' => 'Advanced'],
                    Skill::where('name', 'PHP')->value('id') => ['proficiency_level' => 'Advanced'],
                    Skill::where('name', 'MySQL')->value('id') => ['proficiency_level' => 'Intermediate'],
                    Skill::where('name', 'JavaScript')->value('id') => ['proficiency_level' => 'Intermediate'],
                ]);
            }
        }
    }
}
