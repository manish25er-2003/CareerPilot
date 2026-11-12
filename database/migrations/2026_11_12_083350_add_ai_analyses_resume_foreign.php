<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_analyses', function (Blueprint $table) {
            $table->foreign('resume_id')->references('id')->on('resumes')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('ai_analyses', function (Blueprint $table) {
            $table->dropForeign(['resume_id']);
        });
    }
};
