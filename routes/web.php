<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AiResumeAnalysisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/features', [WebsiteController::class, 'features'])->name('features');
Route::get('/how-it-works', [WebsiteController::class, 'howItWorks'])->name('how-it-works');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::get('/developer', [WebsiteController::class, 'developer'])->name('developer');
Route::post('/contact', [WebsiteController::class, 'storeContact'])->name('contact.store');
Route::get('/sitemap.xml', [WebsiteController::class, 'sitemap'])->name('sitemap');
Route::get('/privacy-policy', [WebsiteController::class, 'privacy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [WebsiteController::class, 'terms'])->name('terms-and-conditions');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['post', 'patch'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::put('/skills/{id}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('/skills/{id}', [SkillController::class, 'destroy'])->name('skills.destroy');

    Route::get('/resumes', [ResumeController::class, 'index'])->name('resumes.index');
    Route::post('/resumes', [ResumeController::class, 'store'])->name('resumes.store');
    Route::get('/resumes/{id}', [ResumeController::class, 'show'])->name('resumes.show');
    Route::get('/resumes/{id}/download', [ResumeController::class, 'download'])->name('resumes.download');
    Route::post('/resumes/{id}/primary', [ResumeController::class, 'markPrimary'])->name('resumes.primary');
    Route::delete('/resumes/{id}', [ResumeController::class, 'destroy'])->name('resumes.destroy');

    Route::get('/ai-analysis', [AiResumeAnalysisController::class, 'index'])->name('ai-analysis.index');
    Route::post('/ai-analysis', [AiResumeAnalysisController::class, 'store'])->name('ai-analysis.store');

    Route::get('/jobs', [JobApplicationController::class, 'index'])->name('jobs.index');
    Route::post('/jobs', [JobApplicationController::class, 'store'])->name('jobs.store');
    Route::put('/jobs/{id}', [JobApplicationController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobApplicationController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/interviews', [InterviewController::class, 'index'])->name('interviews.index');
    Route::post('/interviews', [InterviewController::class, 'store'])->name('interviews.store');
    Route::get('/interviews/{id}', [InterviewController::class, 'show'])->name('interviews.show');
    Route::post('/interviews/{id}/answer', [InterviewController::class, 'answer'])->name('interviews.answer');

    Route::get('/reports/overview', [ReportController::class, 'overview'])->name('reports.overview');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/users/{id}/toggle', [AdminController::class, 'toggleUserStatus'])->name('admin.users.toggle');
});

require __DIR__ . '/auth.php';
