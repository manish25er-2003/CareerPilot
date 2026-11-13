<?php

namespace Database\Seeders;

use App\Models\AiAnalysis;
use App\Models\InterviewAnswer;
use App\Models\InterviewQuestion;
use App\Models\InterviewSession;
use App\Models\JobApplication;
use App\Models\Profile;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->createDemoUser(
            'user@careerpilot.test',
            'Rayden Carter',
            'user',
            [
                'professional_headline' => 'Product Designer & Career Growth Specialist',
                'location' => 'Bengaluru, India',
                'education' => 'B.Design in Interaction Design',
                'experience_years' => 4,
                'bio' => 'Design-minded product professional focused on user experience, portfolio storytelling, and career momentum.',
                'linkedin_url' => 'https://www.linkedin.com/in/rayden',
                'github_url' => 'https://github.com/rayden',
                'portfolio_url' => 'https://rayden.design',
                'profile_score' => 85,
            ],
            [
                'title' => 'Laravel Developer Resume',
                'text' => "Senior Laravel Developer\n\nProfile Summary\n- Built secure Laravel APIs and backend modules for customer-facing products.\n- Worked with MySQL, job tracking workflows, interview workflows, and reporting dashboards.\n- Improved software delivery quality by stabilizing code reviews and document-driven feature development.\n\nSkills: PHP, Laravel, MySQL, JavaScript, HTML, CSS, Git\n\nExperience\n- Developed backend features using Laravel and MVC architecture.\n- Managed database schemas, migrations, and data integrity for application modules.\n- Collaborated with teams to create user-focused dashboards and reporting systems.\n",
            ],
            [
                [
                    'company_name' => 'Google',
                    'job_title' => 'UI/UX Designer',
                    'location' => 'Bengaluru',
                    'status' => 'Interviewing',
                    'applied_at' => now()->subDays(12),
                    'interview_date' => now()->addDays(2),
                ],
                [
                    'company_name' => 'Gojek',
                    'job_title' => 'Product Designer',
                    'location' => 'Jakarta',
                    'status' => 'Accepted',
                    'applied_at' => now()->subDays(20),
                    'interview_date' => now()->addDays(6),
                ],
                [
                    'company_name' => 'Spotify',
                    'job_title' => 'Interaction Designer',
                    'location' => 'Remote',
                    'status' => 'Applied',
                    'applied_at' => now()->subDays(8),
                    'interview_date' => now()->addDays(9),
                ],
            ],
            [
                'job_title' => 'Senior Laravel Developer',
                'match_percentage' => 89,
                'overall_score' => 88,
            ]
        );

        $this->createDemoUser(
            'admin@careerpilot.test',
            'Demo Admin',
            'admin',
            [
                'professional_headline' => 'Platform Administrator',
                'location' => 'Hyderabad, India',
                'education' => 'MCA',
                'experience_years' => 6,
                'bio' => 'Platform administrator managing user onboarding, skills catalog, and product activity.',
                'linkedin_url' => 'https://www.linkedin.com/in/demoadmin',
                'github_url' => 'https://github.com/demoadmin',
                'portfolio_url' => 'https://admin-demo.example.com',
                'profile_score' => 90,
            ],
            [
                'title' => 'Admin Operations Resume',
                'text' => "Operations Lead\n\nSummary\n- Built reporting workflows and lifecycle tracking across platform teams.\n- Managed onboarding, enablement, risk review, and compliance workflows.\n- Improved user support quality for product growth initiatives.\n",
            ],
            [
                [
                    'company_name' => 'CareerPilot',
                    'job_title' => 'Community Manager',
                    'location' => 'Remote',
                    'status' => 'Saved',
                    'applied_at' => now()->subDays(21),
                    'interview_date' => null,
                ],
            ],
            [
                'job_title' => 'Platform Operations Manager',
                'match_percentage' => 82,
                'overall_score' => 80,
            ]
        );

        $demoUsers = [
            [
                'email' => 'aarav.sharma@careerpilot.test',
                'name' => 'Aarav Sharma',
                'role' => 'user',
                'headline' => 'Frontend Developer',
                'location' => 'Delhi, India',
                'education' => 'B.Tech in Computer Science',
                'experience_years' => 3,
                'bio' => 'Frontend specialist building accessible, performance-focused interfaces and dashboards.',
                'linkedin_url' => 'https://www.linkedin.com/in/aaravsharma',
                'github_url' => 'https://github.com/aaravsharma',
                'portfolio_url' => 'https://aaravsharma.dev',
                'resume_title' => 'Frontend Developer Resume',
                'resume_text' => "Frontend Developer\n\nSummary\n- Delivered accessible interfaces for SaaS products with strong design systems.\n- Improved performance and interactions across multiple customer journeys.\n- Built reusable UI components with React and Vue.\n",
                'applications' => [
                    ['company_name' => 'Paytm', 'job_title' => 'Frontend Engineer', 'location' => 'Noida', 'status' => 'Applied', 'applied_at' => now()->subDays(17), 'interview_date' => now()->addDays(4)],
                    ['company_name' => 'Flipkart', 'job_title' => 'UI Engineer', 'location' => 'Bengaluru', 'status' => 'Shortlisted', 'applied_at' => now()->subDays(26), 'interview_date' => now()->addDays(1)],
                ],
                'analysis' => ['job_title' => 'Frontend Engineer', 'match_percentage' => 91, 'overall_score' => 90],
            ],
            [
                'email' => 'neha.patel@careerpilot.test',
                'name' => 'Neha Patel',
                'role' => 'user',
                'headline' => 'Data Analyst',
                'location' => 'Mumbai, India',
                'education' => 'B.Sc in Statistics',
                'experience_years' => 2,
                'bio' => 'Analytics-focused professional translating customer and product data into decisions.',
                'linkedin_url' => 'https://www.linkedin.com/in/neha-patel',
                'github_url' => 'https://github.com/neha-patel',
                'portfolio_url' => 'https://neha-analytics.dev',
                'resume_title' => 'Data Analyst Resume',
                'resume_text' => "Data Analyst\n\nSummary\n- Partnered with marketing and product teams to model performance and conversion trends.\n- Built dashboards and automated reporting for business insights.\n- Applied SQL and Python to improve operational efficiency.\n",
                'applications' => [
                    ['company_name' => 'Zomato', 'job_title' => 'Data Analyst', 'location' => 'Gurugram', 'status' => 'Interviewing', 'applied_at' => now()->subDays(11), 'interview_date' => now()->addDays(3)],
                    ['company_name' => 'Amazon', 'job_title' => 'Business Analyst', 'location' => 'Bengaluru', 'status' => 'Rejected', 'applied_at' => now()->subDays(33), 'interview_date' => null],
                    ['company_name' => 'Microsoft', 'job_title' => 'Product Analyst', 'location' => 'Hyderabad', 'status' => 'Saved', 'applied_at' => now()->subDays(5), 'interview_date' => null],
                ],
                'analysis' => ['job_title' => 'Business Analyst', 'match_percentage' => 84, 'overall_score' => 82],
            ],
            [
                'email' => 'rahul.verma@careerpilot.test',
                'name' => 'Rahul Verma',
                'role' => 'user',
                'headline' => 'Backend Engineer',
                'location' => 'Pune, India',
                'education' => 'B.E. in Information Technology',
                'experience_years' => 5,
                'bio' => 'Backend engineer building API reliability, integrations, and cloud automation for product teams.',
                'linkedin_url' => 'https://www.linkedin.com/in/rahulverma',
                'github_url' => 'https://github.com/rahulverma',
                'portfolio_url' => 'https://rahulverma.dev',
                'resume_title' => 'Backend Engineer Resume',
                'resume_text' => "Backend Engineer\n\nSummary\n- Built distributed service integrations and schema-driven APIs.\n- Improved end-to-end reliability via monitoring, CI automation, and observability.\n- Worked across queues, caching, and event-driven systems.\n",
                'applications' => [
                    ['company_name' => 'Razorpay', 'job_title' => 'Backend Engineer', 'location' => 'Bengaluru', 'status' => 'Shortlisted', 'applied_at' => now()->subDays(18), 'interview_date' => now()->addDays(1)],
                    ['company_name' => 'Swiggy', 'job_title' => 'Platform Engineer', 'location' => 'Bengaluru', 'status' => 'Applied', 'applied_at' => now()->subDays(9), 'interview_date' => null],
                ],
                'analysis' => ['job_title' => 'Platform Engineer', 'match_percentage' => 87, 'overall_score' => 86],
            ],
            [
                'email' => 'sneha.iyer@careerpilot.test',
                'name' => 'Sneha Iyer',
                'role' => 'user',
                'headline' => 'UX Researcher',
                'location' => 'Bengaluru, India',
                'education' => 'M.A. in Human-Centered Design',
                'experience_years' => 4,
                'bio' => 'Research-driven designer turning qualitative insight into product clarity and stronger experiences.',
                'linkedin_url' => 'https://www.linkedin.com/in/sneha-iyer',
                'github_url' => 'https://github.com/sneha-iyer',
                'portfolio_url' => 'https://sneha.design',
                'resume_title' => 'UX Researcher Resume',
                'resume_text' => "UX Researcher\n\nSummary\n- Led interviews, usability studies, and mixed-method research programs.\n- Connected user insight to roadmap decisions and design improvements.\n- Built evidence-based recommendations for product teams.\n",
                'applications' => [
                    ['company_name' => 'Adobe', 'job_title' => 'UX Researcher', 'location' => 'Remote', 'status' => 'Accepted', 'applied_at' => now()->subDays(40), 'interview_date' => now()->addDays(7)],
                    ['company_name' => 'Airbnb', 'job_title' => 'Researcher', 'location' => 'Bengaluru', 'status' => 'Interviewing', 'applied_at' => now()->subDays(14), 'interview_date' => now()->addDays(2)],
                ],
                'analysis' => ['job_title' => 'UX Researcher', 'match_percentage' => 88, 'overall_score' => 89],
            ],
            [
                'email' => 'vikram.nair@careerpilot.test',
                'name' => 'Vikram Nair',
                'role' => 'user',
                'headline' => 'DevOps Engineer',
                'location' => 'Hyderabad, India',
                'education' => 'B.E. in Computer Science',
                'experience_years' => 6,
                'bio' => 'DevOps engineer enabling resilient deployments, automation, and better developer experience.',
                'linkedin_url' => 'https://www.linkedin.com/in/vikramnair',
                'github_url' => 'https://github.com/vikramnair',
                'portfolio_url' => 'https://vikramnair.dev',
                'resume_title' => 'DevOps Engineer Resume',
                'resume_text' => "DevOps Engineer\n\nSummary\n- Automated deployments, infrastructure provisioning, and release safeguards.\n- Improved reliability and observability across web and backend workloads.\n- Partnered with engineering teams to streamline delivery workflows.\n",
                'applications' => [
                    ['company_name' => 'Atlassian', 'job_title' => 'DevOps Engineer', 'location' => 'Remote', 'status' => 'Applied', 'applied_at' => now()->subDays(6), 'interview_date' => null],
                    ['company_name' => 'Cognizant', 'job_title' => 'Cloud Engineer', 'location' => 'Chennai', 'status' => 'Rejected', 'applied_at' => now()->subDays(28), 'interview_date' => null],
                    ['company_name' => 'Freshworks', 'job_title' => 'Site Reliability Engineer', 'location' => 'Chennai', 'status' => 'Shortlisted', 'applied_at' => now()->subDays(15), 'interview_date' => now()->addDays(5)],
                ],
                'analysis' => ['job_title' => 'DevOps Engineer', 'match_percentage' => 86, 'overall_score' => 85],
            ],
        ];

        foreach ($demoUsers as $demoUser) {
            $this->createDemoUser(
                $demoUser['email'],
                $demoUser['name'],
                $demoUser['role'],
                [
                    'professional_headline' => $demoUser['headline'],
                    'location' => $demoUser['location'],
                    'education' => $demoUser['education'],
                    'experience_years' => $demoUser['experience_years'],
                    'bio' => $demoUser['bio'],
                    'linkedin_url' => $demoUser['linkedin_url'],
                    'github_url' => $demoUser['github_url'],
                    'portfolio_url' => $demoUser['portfolio_url'],
                    'profile_score' => rand(78, 92),
                ],
                [
                    'title' => $demoUser['resume_title'],
                    'text' => $demoUser['resume_text'],
                ],
                $demoUser['applications'],
                $demoUser['analysis']
            );
        }
    }

    protected function createDemoUser(
        string $email,
        string $name,
        string $role,
        array $profileData,
        array $resumeData,
        array $applications,
        array $analysisData,
    ): void {
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => $role,
                'is_active' => true,
            ]
        );

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'full_name' => $name,
                'phone' => '+91 ' . rand(7000000000, 9999999999),
                'professional_headline' => $profileData['professional_headline'],
                'location' => $profileData['location'],
                'education' => $profileData['education'],
                'experience_years' => $profileData['experience_years'],
                'bio' => $profileData['bio'],
                'linkedin_url' => $profileData['linkedin_url'],
                'github_url' => $profileData['github_url'],
                'portfolio_url' => $profileData['portfolio_url'],
                'profile_score' => $profileData['profile_score'],
            ]
        );

        $resume = Resume::updateOrCreate(
            ['user_id' => $user->id, 'title' => $resumeData['title']],
            [
                'title' => $resumeData['title'],
                'file_path' => 'resumes/' . $user->id . '/' . str($resumeData['title'])->slug() . '.txt',
                'original_name' => str($resumeData['title'])->slug() . '.txt',
                'mime_type' => 'text/plain',
                'size' => strlen($resumeData['text']) * 2,
                'is_primary' => true,
            ]
        );

        Storage::disk('local')->put($resume->file_path, $resumeData['text']);

        foreach ($applications as $job) {
            JobApplication::updateOrCreate(
                ['user_id' => $user->id, 'company_name' => $job['company_name'], 'job_title' => $job['job_title']],
                [
                    'company_name' => $job['company_name'],
                    'job_title' => $job['job_title'],
                    'job_url' => 'https://example.com/jobs/' . str($job['job_title'])->slug() . '-' . str($job['company_name'])->slug(),
                    'location' => $job['location'],
                    'salary_range' => '₹' . rand(14, 32) . ' LPA',
                    'job_type' => rand(0, 1) ? 'Full-time' : 'Remote',
                    'status' => $job['status'],
                    'applied_at' => $job['applied_at'],
                    'interview_date' => $job['interview_date'],
                    'notes' => 'Demo application record created for dashboard visibility.',
                    'user_id' => $user->id,
                ]
            );
        }

        $analysis = AiAnalysis::updateOrCreate(
            ['user_id' => $user->id, 'resume_id' => $resume->id, 'job_title' => $analysisData['job_title']],
            [
                'user_id' => $user->id,
                'resume_id' => $resume->id,
                'job_title' => $analysisData['job_title'],
                'job_description' => 'Role focused analysis for career alignment and ATS optimization.',
                'overall_score' => $analysisData['overall_score'],
                'match_percentage' => $analysisData['match_percentage'],
                'strengths' => ['Role-aligned experience', 'Clear career progression', 'Strong portfolio evidence'],
                'weaknesses' => ['Add measurable business impact', 'Improve keyword density'],
                'missing_skills' => ['System design', 'Interview storytelling'],
                'recommended_skills' => ['Portfolio case studies', 'Leadership examples'],
                'ats_suggestions' => ['Use role-specific keywords', 'Add quantified achievements'],
                'summary' => 'Demo AI analysis for dashboard proof and profile readiness.',
                'status' => 'completed',
            ]
        );

        $session = InterviewSession::updateOrCreate(
            ['user_id' => $user->id, 'role' => $analysisData['job_title']],
            [
                'difficulty' => rand(0, 1) ? 'Medium' : 'Hard',
                'category' => 'Technical',
                'status' => 'completed',
                'total_score' => $analysisData['overall_score'],
                'summary' => 'Interview coaching summary created for the demo dashboard.',
            ]
        );

        $question = InterviewQuestion::updateOrCreate(
            ['interview_session_id' => $session->id, 'question' => 'Describe a time you improved a product outcome.'],
            [
                'difficulty' => 'Medium',
                'category' => 'Behavioral',
            ]
        );

        InterviewAnswer::updateOrCreate(
            ['interview_question_id' => $question->id],
            [
                'answer_text' => 'I improved the onboarding journey by mapping the friction points, simplifying the flow, and measuring conversion before and after the release.',
                'score' => $analysisData['overall_score'],
                'feedback' => 'Strong examples and measurable impact.',
                'strengths' => ['Clear structure', 'Quantified outcome'],
                'weaknesses' => ['Could add one more concrete metric'],
                'suggested_answer' => 'Use the STAR method and highlight measurable customer impact.',
            ]
        );
    }
}
