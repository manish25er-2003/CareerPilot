<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('resume_id')->nullable();
            $table->string('job_title')->nullable();
            $table->text('job_description')->nullable();
            $table->unsignedTinyInteger('overall_score')->default(0);
            $table->unsignedTinyInteger('match_percentage')->default(0);
            $table->json('strengths')->nullable();
            $table->json('weaknesses')->nullable();
            $table->json('missing_skills')->nullable();
            $table->json('recommended_skills')->nullable();
            $table->json('ats_suggestions')->nullable();
            $table->text('summary')->nullable();
            $table->string('status')->default('completed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_analyses');
    }
};
