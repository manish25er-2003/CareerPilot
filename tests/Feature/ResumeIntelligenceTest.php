<?php

namespace Tests\Feature;

use App\Models\AiAnalysis;
use App\Models\Resume;
use App\Models\User;
use App\Services\Ai\ResumeAnalysisService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use ZipArchive;

class ResumeIntelligenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_resume_analysis_extracts_and_saves_recommendations_and_roadmap(): void
    {
        Storage::fake('local');
        config(['services.gemini.key' => null]);
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/resumes', [
                'title' => 'Uploaded engineer resume',
                'file' => UploadedFile::fake()->createWithContent('resume.txt', $this->sampleResume()),
            ])
            ->assertRedirect(route('resumes.index'));

        $resume = $user->resumes()->firstOrFail();

        $this->actingAs($user)
            ->post('/ai-analysis', ['resume_id' => $resume->id])
            ->assertRedirect(route('ai-analysis.index'));

        $analysis = AiAnalysis::query()->where('user_id', $user->id)->firstOrFail();
        $this->assertSame('local', $analysis->analysis_source);
        $this->assertSame(['Bachelor of Science in Computer Science'], $analysis->structured_profile['education']);
        $this->assertContains('laravel', $analysis->structured_profile['skills']);
        $this->assertContains('Built an internal reporting API.', $analysis->structured_profile['projects']);
        $this->assertNotEmpty($analysis->role_recommendations);
        $this->assertNotEmpty($analysis->career_roadmap);

        $this->actingAs($user)
            ->get('/ai-analysis')
            ->assertOk()
            ->assertSee('Recommended job profiles')
            ->assertSee('Skill gaps and learning recommendations')
            ->assertSee('Career roadmap')
            ->assertSee('Local resume-based analysis');

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Recommended Job Profiles')
            ->assertSee($analysis->role_recommendations[0]['role_title'])
            ->assertSee('Track this role');

        $this->actingAs($user)
            ->get(route('jobs.index', ['job_title' => $analysis->role_recommendations[0]['role_title']]))
            ->assertOk()
            ->assertSee('value="'.$analysis->role_recommendations[0]['role_title'].'"', false);
    }

    public function test_api_analysis_persists_structured_resume_intelligence(): void
    {
        Storage::fake('local');
        config(['services.gemini.key' => null]);
        $user = User::factory()->create();
        $resume = $this->createTextResume($user);
        $token = $user->createToken('test')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/ai/resume-analysis', [
                'resume_id' => $resume->id,
                'job_title' => 'Backend Developer',
                'job_description' => 'We need PHP, Laravel, SQL, Docker, and AWS experience.',
            ])
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'matched_skills',
                    'missing_skills',
                    'structured_profile',
                    'role_recommendations',
                    'skill_gaps',
                    'career_roadmap',
                    'learning_recommendations',
                    'analysis_source',
                ],
            ]);

        $this->assertDatabaseHas('ai_analyses', [
            'user_id' => $user->id,
            'job_title' => 'Backend Developer',
            'analysis_source' => 'local',
        ]);

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/dashboard')
            ->assertOk()
            ->assertJsonStructure([
                'latest_resume_analysis' => ['role_recommendations', 'career_roadmap'],
            ]);
    }

    public function test_api_rejects_a_resume_file_that_cannot_be_extracted(): void
    {
        Storage::fake('local');
        config(['services.gemini.key' => null]);
        $user = User::factory()->create();
        $resume = Resume::create([
            'user_id' => $user->id,
            'title' => 'Missing resume',
            'file_path' => 'resumes/'.$user->id.'/missing.txt',
            'original_name' => 'missing.txt',
            'mime_type' => 'text/plain',
            'size' => 100,
        ]);
        $token = $user->createToken('test')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/ai/resume-analysis', ['resume_id' => $resume->id])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('resume_id');

        $this->assertDatabaseCount('ai_analyses', 0);
    }

    public function test_pdf_extraction_reads_complete_text_from_a_real_pdf(): void
    {
        $temporaryPath = tempnam(sys_get_temp_dir(), 'careerpilot-resume-');
        $path = $temporaryPath.'.pdf';
        rename($temporaryPath, $path);
        file_put_contents($path, $this->makePdf('Senior Product Manager'));

        try {
            $text = app(ResumeAnalysisService::class)->extractTextFromFile($path, 'application/pdf');
            $this->assertStringContainsString('Senior Product Manager', $text);
        } finally {
            unlink($path);
        }
    }

    public function test_docx_extraction_reads_paragraphs_and_tables(): void
    {
        $temporaryPath = tempnam(sys_get_temp_dir(), 'careerpilot-resume-');
        $path = $temporaryPath.'.docx';
        rename($temporaryPath, $path);
        $zip = new ZipArchive;
        $this->assertTrue($zip->open($path, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true);
        $zip->addFromString(
            'word/document.xml',
            '<?xml version="1.0" encoding="UTF-8"?>'.
            '<w:document xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:body>'.
            '<w:p><w:r><w:t>Experience</w:t></w:r></w:p>'.
            '<w:p><w:r><w:t>Built reporting tools</w:t></w:r></w:p>'.
            '<w:tbl><w:tr><w:tc><w:p><w:r><w:t>Project delivery</w:t></w:r></w:p></w:tc></w:tr></w:tbl>'.
            '</w:body></w:document>'
        );
        $zip->close();

        try {
            $text = app(ResumeAnalysisService::class)->extractTextFromFile(
                $path,
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            );
            $this->assertStringContainsString('Built reporting tools', $text);
            $this->assertStringContainsString('Project delivery', $text);
        } finally {
            unlink($path);
        }
    }

    public function test_gemini_response_is_used_when_configured_and_valid(): void
    {
        config(['services.gemini.key' => 'test-key']);
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [[
                    'content' => ['parts' => [[
                        'text' => json_encode([
                            'overall_score' => 88,
                            'match_percentage' => 75,
                            'summary' => 'Good target role alignment.',
                            'strengths' => ['Relevant backend experience'],
                            'weaknesses' => ['Add more impact metrics'],
                            'ats_suggestions' => ['Use standard headings'],
                            'profile' => [
                                'education' => ['BSc Computer Science'],
                                'skills' => ['PHP', 'Laravel'],
                                'experience' => ['Backend engineer'],
                                'projects' => ['Reporting API'],
                            ],
                            'matched_skills' => ['Laravel'],
                            'missing_skills' => ['Docker'],
                            'role_recommendations' => [[
                                'role_title' => 'Backend Engineer',
                                'match_percentage' => 75,
                                'explanation' => 'Laravel experience matches.',
                                'matched_skills' => ['Laravel'],
                                'missing_skills' => ['Docker'],
                            ]],
                            'skill_gaps' => [[
                                'skill' => 'Docker',
                                'priority' => 'high',
                                'reason' => 'Role requirement',
                                'learning_recommendation' => 'Build a containerized app.',
                            ]],
                            'career_roadmap' => [[
                                'timeframe' => 'Month 1',
                                'focus' => 'Containers',
                                'actions' => ['Containerize a small project.'],
                            ]],
                            'learning_recommendations' => [[
                                'skill' => 'Docker',
                                'recommendation' => 'Build a containerized app.',
                            ]],
                        ]),
                    ]]],
                ]],
            ]),
        ]);

        $result = app(ResumeAnalysisService::class)->analyze('Laravel backend developer', 'Laravel and Docker role', 'Backend Engineer');

        $this->assertSame('gemini', $result['analysis_source']);
        $this->assertSame(75, $result['match_percentage']);
        $this->assertSame('Docker', $result['missing_skills'][0]);
        $this->assertSame('Backend Engineer', $result['role_recommendations'][0]['role_title']);
    }

    public function test_gemini_failure_is_labeled_and_uses_local_resume_analysis(): void
    {
        config(['services.gemini.key' => 'test-key']);
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([], 503),
        ]);

        $result = app(ResumeAnalysisService::class)->analyze(
            'PHP Laravel SQL backend engineer',
            'PHP Laravel Docker role',
            'Backend Engineer'
        );

        $this->assertSame('local', $result['analysis_source']);
        $this->assertStringContainsString('Gemini was unavailable', $result['provider_notice']);
        $this->assertNotEmpty($result['role_recommendations']);
    }

    private function createTextResume(User $user): Resume
    {
        $path = 'resumes/'.$user->id.'/resume.txt';
        Storage::disk('local')->put($path, $this->sampleResume());

        return Resume::create([
            'user_id' => $user->id,
            'title' => 'Software Engineer Resume',
            'file_path' => $path,
            'original_name' => 'resume.txt',
            'mime_type' => 'text/plain',
            'size' => 300,
            'is_primary' => true,
        ]);
    }

    private function sampleResume(): string
    {
        return implode("\n", [
            'Education',
            'Bachelor of Science in Computer Science',
            'Skills',
            'PHP, Laravel, SQL, Git, Docker, AWS, Python, Tableau',
            'Experience',
            'Software Engineer at Example Co.',
            'Delivered backend services used by 10,000 customers.',
            'Projects',
            'Built an internal reporting API.',
        ]);
    }

    private function makePdf(string $text): string
    {
        $stream = "BT /F1 12 Tf 72 720 Td ({$text}) Tj ET";
        $objects = [
            '<< /Type /Catalog /Pages 2 0 R >>',
            '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>',
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
            '<< /Length '.strlen($stream)." >>\nstream\n{$stream}\nendstream",
        ];
        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $index => $object) {
            $offsets[] = strlen($pdf);
            $pdf .= ($index + 1)." 0 obj\n{$object}\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $pdf .= 'xref'."\n0 ".(count($objects) + 1)."\n0000000000 65535 f \n";
        foreach (array_slice($offsets, 1) as $offset) {
            $pdf .= sprintf("%010d 00000 n \n", $offset);
        }

        return $pdf."trailer\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\nstartxref\n{$xrefOffset}\n%%EOF\n";
    }
}
