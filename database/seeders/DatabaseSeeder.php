<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        if (! app()->environment('local')) {
            return;
        }

        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            SkillSeeder::class,
            CategorySeeder::class,
            ResumeSeeder::class,
            JobApplicationSeeder::class,
            AiAnalysisSeeder::class,
            InterviewSeeder::class,
            UserSettingSeeder::class,
            NotificationSeeder::class,
            ContactMessageSeeder::class,
            ActivityLogSeeder::class,
        ]);
    }
}
