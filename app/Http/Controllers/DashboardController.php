<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $profile = $user?->profile;

        $displayName = $user?->name ?: 'User';
        $displayEmail = $user?->email ?: 'user@example.com';
        $firstName = trim(explode(' ', $displayName)[0] ?? 'User');
        $initials = collect(explode(' ', trim($displayName)))
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->take(2)
            ->implode('');

        $profileImage = $profile && $profile->profile_image
            ? Storage::url($profile->profile_image)
            : null;

        $summaryCards = [
            ['label' => 'Total Applications Sent', 'value' => 60, 'meta' => 'Overview of all submitted applications', 'active' => true],
            ['label' => 'Active Applications', 'value' => 38, 'meta' => 'Ongoing applications in progress', 'active' => false],
            ['label' => 'Waiting for Interview', 'value' => 15, 'meta' => 'Applications in the interview queue', 'active' => false],
            ['label' => 'Offer Received', 'value' => 7, 'meta' => 'Jobs offering interview or job offer', 'active' => false],
        ];

        $schedule = [
            ['title' => 'Technical Test', 'company' => 'Google', 'date' => 'November 2024', 'time' => '08:00 - 10:00 AM', 'badge' => 'Technical Test'],
            ['title' => 'User Interview', 'company' => 'Traveloka', 'date' => 'November 2024', 'time' => '08:00 - 10:00 AM', 'badge' => 'User Interview'],
            ['title' => 'Contract Reading', 'company' => 'Gojek', 'date' => 'UX/UX Designer', 'time' => '08:00 - 10:00 AM', 'badge' => 'Contract Reading'],
        ];

        $applicationRows = [
            ['company' => 'Gojek', 'role' => 'UI/UX Designer', 'location' => 'South Jakarta', 'status' => 'Accepted', 'statusClass' => 'success', 'date' => 'Today, 12:46PM'],
            ['company' => 'Shopee Indonesia', 'role' => 'Web Designer', 'location' => 'South Jakarta', 'status' => 'Accepted', 'statusClass' => 'success', 'date' => 'Today, 12:46PM'],
            ['company' => 'Traveloka', 'role' => 'UI Designer', 'location' => 'Bandung, West Java', 'status' => 'Interview', 'statusClass' => 'warning', 'date' => 'Yesterday, 12:46PM'],
            ['company' => 'Agoda', 'role' => 'Motion Designer', 'location' => 'North Jakarta', 'status' => 'In Progress', 'statusClass' => 'info', 'date' => '25 November 2024'],
            ['company' => 'Tokopedia', 'role' => 'UX Researcher', 'location' => 'Tangerang, Banten', 'status' => 'Rejected', 'statusClass' => 'danger', 'date' => '24 November 2024'],
        ];

        $resumeStrength = [
            'Profile Summary' => 85,
            'Work Experience' => 90,
            'Skill Section' => 85,
            'Education' => 80,
        ];

        $recommendedJobs = [
            ['title' => 'UI/UX Designer', 'company' => 'Gojek', 'location' => 'South Jakarta', 'days' => '2 days ago', 'tone' => 'purple'],
            ['title' => 'Web Designer', 'company' => 'Shopee Indonesia', 'location' => 'South Jakarta', 'days' => '2 days ago', 'tone' => 'light'],
            ['title' => 'UI Designer', 'company' => 'Traveloka', 'location' => 'Bandung, West Java', 'days' => '2 days ago', 'tone' => 'soft'],
        ];

        $footerLinks = [
            'Help & Support',
            'Settings',
        ];

        return view('dashboard', compact(
            'user',
            'displayName',
            'displayEmail',
            'firstName',
            'initials',
            'profileImage',
            'summaryCards',
            'schedule',
            'applicationRows',
            'resumeStrength',
            'recommendedJobs',
            'footerLinks'
        ));
    }
}
