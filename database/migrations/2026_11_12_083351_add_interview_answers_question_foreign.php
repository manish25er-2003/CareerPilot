<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interview_answers', function (Blueprint $table) {
            $table->foreign('interview_question_id')->references('id')->on('interview_questions')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('interview_answers', function (Blueprint $table) {
            $table->dropForeign(['interview_question_id']);
        });
    }
};
