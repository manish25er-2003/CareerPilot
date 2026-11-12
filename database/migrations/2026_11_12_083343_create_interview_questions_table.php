<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interview_session_id')->constrained()->cascadeOnDelete();
            $table->text('question');
            $table->string('difficulty')->default('Medium');
            $table->string('category')->default('Technical');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_questions');
    }
};
