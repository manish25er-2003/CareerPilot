<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('professional_headline')->nullable();
            $table->string('location')->nullable();
            $table->text('education')->nullable();
            $table->unsignedTinyInteger('experience_years')->default(0);
            $table->text('bio')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->unsignedTinyInteger('profile_score')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
