<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Seeder;

class UserSettingSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['user@careerpilot.test', 'admin@careerpilot.test'] as $email) {
            $user = User::where('email', $email)->first();

            if ($user) {
                UserSetting::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'theme' => 'light',
                        'notification_email' => true,
                        'interview_reminders' => true,
                        'job_alerts' => true,
                        'timezone' => 'Asia/Kolkata',
                        'account_status' => 'active',
                    ]
                );
            }
        }
    }
}
