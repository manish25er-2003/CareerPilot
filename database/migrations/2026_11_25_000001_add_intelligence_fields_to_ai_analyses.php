<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_analyses', function (Blueprint $table) {
            $table->json('structured_profile')->nullable();
            $table->json('role_recommendations')->nullable();
            $table->json('matched_skills')->nullable();
            $table->json('skill_gaps')->nullable();
            $table->json('career_roadmap')->nullable();
            $table->json('learning_recommendations')->nullable();
            $table->string('analysis_source')->default('local');
        });
    }

    public function down(): void
    {
        Schema::table('ai_analyses', function (Blueprint $table) {
            $table->dropColumn([
                'structured_profile',
                'role_recommendations',
                'matched_skills',
                'skill_gaps',
                'career_roadmap',
                'learning_recommendations',
                'analysis_source',
            ]);
        });
    }
};
