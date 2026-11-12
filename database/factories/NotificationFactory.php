<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => 'info',
            'title' => 'Career update',
            'message' => 'Your resume analysis is ready.',
            'is_read' => false,
            'related_id' => null,
        ];
    }
}
