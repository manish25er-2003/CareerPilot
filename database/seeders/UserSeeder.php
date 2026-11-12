<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'user@careerpilot.test'],
            [
                'name' => 'Demo User',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@careerpilot.test'],
            [
                'name' => 'Demo Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        User::factory(3)->create();
    }
}
