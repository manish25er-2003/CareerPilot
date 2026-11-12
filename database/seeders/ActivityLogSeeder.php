<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@careerpilot.test')->first();

        if (! $user) {
            return;
        }

        ActivityLog::updateOrCreate(
            ['user_id' => $user->id, 'action' => 'resume_uploaded'],
            [
                'model_type' => 'App\\Models\\Resume',
                'model_id' => 1,
                'action' => 'resume_uploaded',
                'description' => 'Sample resume uploaded for the demo account.',
            ]
        );
    }
}
