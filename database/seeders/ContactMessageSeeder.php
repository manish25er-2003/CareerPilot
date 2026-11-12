<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        ContactMessage::updateOrCreate(
            ['email' => 'hello@careerpilot.test', 'subject' => 'Demo inquiry'],
            [
                'name' => 'Sample Visitor',
                'email' => 'hello@careerpilot.test',
                'subject' => 'Demo inquiry',
                'message' => 'This is a sample contact inquiry used in development and demo mode.',
                'status' => 'new',
            ]
        );
    }
}
