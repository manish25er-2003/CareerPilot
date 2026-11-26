<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resume_builder_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title', 120)->default('My Resume');
            $table->string('template', 24)->default('modern');
            $table->char('theme_color', 7)->default('#704CE3');
            $table->char('heading_color', 7)->default('#292044');
            $table->json('personal_information');
            $table->json('work_experience');
            $table->json('education');
            $table->json('skills');
            $table->json('projects');
            $table->json('certifications');
            $table->json('languages');
            $table->json('additional_sections');
            $table->string('profile_photo_path')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'updated_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resume_builder_documents');
    }
};
