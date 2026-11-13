<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\AiAnalysis;
use App\Models\ContactMessage;
use App\Models\InterviewSession;
use App\Models\JobApplication;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'resumes' => Resume::count(),
            'applications' => JobApplication::count(),
            'analyses' => AiAnalysis::count(),
            'interviews' => InterviewSession::count(),
            'completed_interviews' => InterviewSession::where('status', 'completed')->count(),
            'contact_messages' => ContactMessage::count(),
        ];

        $contacts = ContactMessage::latest()->limit(10)->get();
        $recentUsers = User::latest()->limit(5)->get();
        $recentActivities = ActivityLog::with('user')->latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'contacts', 'recentUsers', 'recentActivities'));
    }

    public function toggleUserStatus(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => ! $user->is_active]);

        return redirect()->route('admin.dashboard')->with('success', 'User status updated.');
    }
}
