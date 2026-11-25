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
        $totalUsers = User::count();
        $platformStats = [
            'users' => $totalUsers,
            'resumes' => Resume::count(),
            'applications' => JobApplication::count(),
        ];

        $metricMembers = [
            'resume-completion' => Resume::query()->distinct()->count('user_id'),
            'applications' => JobApplication::query()->distinct()->count('user_id'),
            'interview-practice' => InterviewSession::query()->distinct()->count('user_id'),
            'ai-analysis' => AiAnalysis::query()
                ->where('status', 'completed')
                ->distinct()
                ->count('user_id'),
        ];

        $livePlatformMetrics = [
            [
                'key' => 'resume-completion',
                'title' => 'Resume Completion',
                'description' => 'Members who have uploaded a resume',
                'member_count' => $metricMembers['resume-completion'],
            ],
            [
                'key' => 'applications',
                'title' => 'Applications',
                'description' => 'Members tracking a job application',
                'member_count' => $metricMembers['applications'],
            ],
            [
                'key' => 'interview-practice',
                'title' => 'Interview Practice',
                'description' => 'Members who started a practice session',
                'member_count' => $metricMembers['interview-practice'],
            ],
            [
                'key' => 'ai-analysis',
                'title' => 'AI Analysis',
                'description' => 'Members with a completed AI analysis',
                'member_count' => $metricMembers['ai-analysis'],
            ],
        ];

        foreach ($livePlatformMetrics as &$metric) {
            $metric['percentage'] = $totalUsers > 0
                ? (int) round(($metric['member_count'] / $totalUsers) * 100)
                : null;
        }
        unset($metric);

        $careerStats = null;
        $workflowRecommendations = null;
        if ($user = auth()->user()) {
            $completedAnalyses = $user->aiAnalyses()->where('status', 'completed');
            $analysisCount = (clone $completedAnalyses)->count();
            $firstAnalysis = (clone $completedAnalyses)
                ->orderBy('created_at')
                ->orderBy('id')
                ->first(['overall_score']);
            $latestAnalysis = (clone $completedAnalyses)
                ->orderByDesc('created_at')
                ->orderByDesc('id')
                ->first(['overall_score', 'match_percentage', 'role_recommendations']);

            $careerStats = [
                'applications' => $user->jobApplications()->count(),
                'interviews' => $user->interviewSessions()->count(),
                'jobMatch' => $latestAnalysis?->match_percentage,
                'growth' => $analysisCount >= 2 && $firstAnalysis && $latestAnalysis
                    ? $latestAnalysis->overall_score - $firstAnalysis->overall_score
                    : null,
            ];

            $workflowRecommendations = collect($latestAnalysis?->role_recommendations ?? [])
                ->filter(fn ($recommendation) => is_array($recommendation) && trim((string) ($recommendation['role_title'] ?? '')) !== '')
                ->take(3)
                ->values()
                ->all();
        }

        $recentUsers = User::query()
            ->with('profile')
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

        return view('public.home', compact('platformStats', 'livePlatformMetrics', 'careerStats', 'workflowRecommendations', 'recentUsers', 'recentApplications', 'recentResumes'));
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
            'name' => 'Manish Kumar',
            'role' => 'Full Stack Web Developer',
            'intro' => 'I design and build polished digital experiences that help businesses and people move faster, work smarter, and present their work with confidence.',
            'focus' => 'Product-focused web experiences and scalable Laravel applications',
            'experience' => '1+ Year',
            'skills' => [
                ['name' => 'PHP', 'icon' => 'php'],
                ['name' => 'Laravel', 'icon' => 'laravel'],
                ['name' => 'MySQL', 'icon' => 'mysql'],
                ['name' => 'JavaScript', 'icon' => 'javascript'],
                ['name' => 'HTML', 'icon' => 'html'],
                ['name' => 'CSS', 'icon' => 'css'],
                ['name' => 'Bootstrap', 'icon' => 'bootstrap'],
                ['name' => 'Git and GitHub', 'icon' => 'github'],
            ],
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
