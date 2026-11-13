<?php

namespace App\Http\Controllers;

use App\Models\AiAnalysis;
use App\Models\ContactMessage;
use App\Models\InterviewSession;
use App\Models\JobApplication;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function home(): View
    {
        $platformStats = [
            'users' => User::count(),
            'activeUsers' => User::where('is_active', true)->count(),
            'resumes' => Resume::count(),
            'applications' => JobApplication::count(),
            'analyses' => AiAnalysis::count(),
            'interviews' => InterviewSession::count(),
        ];

        $recentUsers = User::query()
            ->latest('created_at')
            ->take(5)
            ->get();

        $recentApplications = JobApplication::query()
            ->with('user')
            ->latest('applied_at')
            ->take(5)
            ->get();

        $recentResumes = Resume::query()
            ->with('user')
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('public.home', compact('platformStats', 'recentUsers', 'recentApplications', 'recentResumes'));
    }

    public function about(): View
    {
        return view('public.about');
    }

    public function features(): View
    {
        return view('public.features');
    }

    public function howItWorks(): View
    {
        return view('public.how-it-works');
    }

    public function contact(): View
    {
        return view('public.contact');
    }

    public function developer(): View
    {
        $developer = [
            'name' => 'Manish Yadav',
            'role' => 'Full Stack Web Developer',
            'intro' => 'I design and build polished digital experiences that help businesses and people move faster, work smarter, and present their work with confidence.',
            'skills' => ['PHP', 'Laravel', 'MySQL', 'JavaScript', 'HTML', 'CSS', 'Bootstrap', 'Git and GitHub'],
            'featuredProject' => 'CareerPilot AI',
            'portfolioUrl' => 'https://manishpro.in',
            'githubUrl' => null,
            'linkedinUrl' => null,
            'email' => null,
        ];

        return view('public.developer', compact('developer'));
    }

    public function privacy(): View
    {
        return view('public.privacy');
    }

    public function terms(): View
    {
        return view('public.terms');
    }

    public function sitemap(): Response
    {
        $urls = [
            ['loc' => route('home'), 'lastmod' => now()->toDateString()],
            ['loc' => route('about'), 'lastmod' => now()->toDateString()],
            ['loc' => route('features'), 'lastmod' => now()->toDateString()],
            ['loc' => route('how-it-works'), 'lastmod' => now()->toDateString()],
            ['loc' => route('contact'), 'lastmod' => now()->toDateString()],
            ['loc' => route('developer'), 'lastmod' => now()->toDateString()],
            ['loc' => route('privacy-policy'), 'lastmod' => now()->toDateString()],
            ['loc' => route('terms-and-conditions'), 'lastmod' => now()->toDateString()],
        ];

        return response()
            ->view('seo.sitemap', ['urls' => $urls], 200)
            ->header('Content-Type', 'application/xml');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email'],
            'subject' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Your message has been sent successfully. Our team will contact you soon.');
    }
}
