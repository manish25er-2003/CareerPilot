<?php

namespace Database\Seeders;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ResumeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@careerpilot.test')->first();

        if (! $user) {
            return;
        }

        $folder = 'resumes/' . $user->id;
        $path = $folder . '/demo-resume.txt';

        Storage::disk('local')->put($path, "Senior Laravel Developer\n\nProfile Summary\n- Built secure Laravel APIs and backend modules for customer-facing products.\n- Worked with MySQL, job tracking workflows, interview workflows, and reporting dashboards.\n- Improved software delivery quality by stabilizing code reviews and document-driven feature development.\n\nSkills: PHP, Laravel, MySQL, JavaScript, HTML, CSS, Git\n\nExperience\n- Developed backend features using Laravel and MVC architecture.\n- Managed database schemas, migrations, and data integrity for application modules.\n- Collaborated with teams to create user-focused dashboards and reporting systems.\n");

        Resume::updateOrCreate(
            ['user_id' => $user->id, 'title' => 'Laravel Developer Resume'],
            [
                'title' => 'Laravel Developer Resume',
                'file_path' => $path,
                'original_name' => 'demo-resume.txt',
                'mime_type' => 'text/plain',
                'size' => 2400,
                'is_primary' => true,
            ]
        );
    }
}
