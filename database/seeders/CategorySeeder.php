<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Backend', 'slug' => 'backend', 'type' => 'skill'],
            ['name' => 'Frontend', 'slug' => 'frontend', 'type' => 'skill'],
            ['name' => 'Database', 'slug' => 'database', 'type' => 'skill'],
            ['name' => 'Technical Interview', 'slug' => 'technical-interview', 'type' => 'interview'],
            ['name' => 'Behavioral Interview', 'slug' => 'behavioral-interview', 'type' => 'interview'],
            ['name' => 'Full-Time', 'slug' => 'full-time', 'type' => 'job'],
            ['name' => 'Remote', 'slug' => 'remote', 'type' => 'job'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
