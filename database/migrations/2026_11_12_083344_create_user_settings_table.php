<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('theme')->default('light');
            $table->boolean('notification_email')->default(true);
            $table->boolean('interview_reminders')->default(true);
            $table->boolean('job_alerts')->default(true);
            $table->string('timezone')->default('UTC');
            $table->string('account_status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
