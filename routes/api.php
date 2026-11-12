<?php

use App\Http\Controllers\ApiAiAnalysisController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiDashboardController;
use App\Http\Controllers\ApiInterviewController;
use App\Http\Controllers\ApiJobApplicationController;
use App\Http\Controllers\ApiProfileController;
use App\Http\Controllers\ApiReportController;
use App\Http\Controllers\ApiResumeController;
use App\Http\Controllers\ApiSettingController;
use App\Http\Controllers\ApiSkillController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/me', [ApiAuthController::class, 'me']);

    Route::get('/dashboard', [ApiDashboardController::class, 'index']);

    Route::get('/profile', [ApiProfileController::class, 'show']);
    Route::put('/profile', [ApiProfileController::class, 'update']);

    Route::get('/skills', [ApiSkillController::class, 'index']);
    Route::post('/skills', [ApiSkillController::class, 'store']);
    Route::put('/skills/{id}', [ApiSkillController::class, 'update']);
    Route::delete('/skills/{id}', [ApiSkillController::class, 'destroy']);

    Route::get('/resumes', [ApiResumeController::class, 'index']);
    Route::post('/resumes', [ApiResumeController::class, 'store']);
    Route::get('/resumes/{id}', [ApiResumeController::class, 'show']);
    Route::delete('/resumes/{id}', [ApiResumeController::class, 'destroy']);

    Route::post('/ai/resume-analysis', [ApiAiAnalysisController::class, 'resumeAnalysis']);
    Route::get('/ai/analyses', [ApiAiAnalysisController::class, 'index']);
    Route::get('/ai/analyses/{id}', [ApiAiAnalysisController::class, 'show']);

    Route::get('/jobs', [ApiJobApplicationController::class, 'index']);
    Route::post('/jobs', [ApiJobApplicationController::class, 'store']);
    Route::get('/jobs/{id}', [ApiJobApplicationController::class, 'show']);
    Route::put('/jobs/{id}', [ApiJobApplicationController::class, 'update']);
    Route::delete('/jobs/{id}', [ApiJobApplicationController::class, 'destroy']);

    Route::get('/interviews', [ApiInterviewController::class, 'index']);
    Route::post('/interviews', [ApiInterviewController::class, 'store']);
    Route::get('/interviews/{id}', [ApiInterviewController::class, 'show']);
    Route::post('/interviews/{id}/answers', [ApiInterviewController::class, 'answer']);

    Route::get('/reports/overview', [ApiReportController::class, 'overview']);

    Route::get('/settings', [ApiSettingController::class, 'index']);
    Route::put('/settings', [ApiSettingController::class, 'update']);
});
