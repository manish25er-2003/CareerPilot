<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interview_question_id');
            $table->longText('answer_text')->nullable();
            $table->unsignedTinyInteger('score')->default(0);
            $table->text('feedback')->nullable();
            $table->json('strengths')->nullable();
            $table->json('weaknesses')->nullable();
            $table->text('suggested_answer')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_answers');
    }
};
