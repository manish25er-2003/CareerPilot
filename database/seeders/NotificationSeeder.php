<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@careerpilot.test')->first();

        if ($user) {
            Notification::updateOrCreate(
                ['user_id' => $user->id, 'title' => 'Resume analysis ready'],
                [
                    'type' => 'info',
                    'message' => 'Your Laravel developer resume analysis is ready for review.',
                    'is_read' => false,
                    'related_id' => null,
                ]
            );
        }
    }
}
