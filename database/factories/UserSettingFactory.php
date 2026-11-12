<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserSetting>
 */
class UserSettingFactory extends Factory
{
    protected $model = UserSetting::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'theme' => 'light',
            'notification_email' => true,
            'interview_reminders' => true,
            'job_alerts' => true,
            'timezone' => 'Asia/Kolkata',
            'account_status' => 'active',
        ];
    }
}
