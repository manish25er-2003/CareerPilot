<?php

namespace Tests\Feature;

use App\Models\Resume;
use App\Models\ResumeBuilderDocument;
use App\Models\User;
use App\Services\Ai\ResumeAnalysisService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ResumeBuilderTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_offers_builder_only_when_user_has_no_resume(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Create Your Professional Resume')
            ->assertSee(route('resume-builder.create'), false);

        ResumeBuilderDocument::create([
            'user_id' => $user->id,
            ...$this->resumeData(),
        ]);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertDontSee('Create Your Professional Resume')
            ->assertSee('Edit Resume')
            ->assertSee('Preview Resume');
    }

    public function test_user_can_save_update_preview_and_download_owned_builder_resumes(): void
    {
        $user = User::factory()->create();
        $data = $this->resumeData();
        $data['personal_information']['name'] = 'Taylor Example';
        $data['skills'] = [['name' => '', 'category' => '', 'proficiency' => '']];
        $data['languages'] = [['name' => '', 'proficiency' => '']];
        $data['additional_sections'] = [['type' => 'custom', 'title' => '', 'content' => '']];

        $response = $this->actingAs($user)
            ->postJson(route('resume-builder.store'), $data)
            ->assertCreated()
            ->assertJsonPath('title', 'My Resume');

        $id = $response->json('id');
        $this->assertDatabaseHas('resume_builder_documents', [
            'id' => $id,
            'user_id' => $user->id,
        ]);

        $this->patchJson(route('resume-builder.update', $id), [
            ...$data,
            'template' => 'executive',
            'title' => 'Taylor Example Resume',
        ])->assertOk()->assertJsonPath('title', 'Taylor Example Resume');

        $this->get(route('resume-builder.preview', $id))
            ->assertOk()
            ->assertSee('Taylor Example')
            ->assertSee('rb-template-executive', false);

        $pdf = $this->get(route('resume-builder.download', $id))
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
        $this->assertStringStartsWith('%PDF-', $pdf->getContent());
        $this->assertStringContainsString('taylor-example-resume.pdf', $pdf->headers->get('content-disposition'));

        $otherUser = User::factory()->create();
        $this->actingAs($otherUser)
            ->get(route('resume-builder.edit', $id))
            ->assertNotFound();
        $this->get(route('resume-builder.download', $id))->assertNotFound();
    }

    public function test_builder_does_not_replace_or_delete_uploaded_resume_records(): void
    {
        $user = User::factory()->create();
        $uploadedResume = Resume::create([
            'user_id' => $user->id,
            'title' => 'Uploaded resume',
            'file_path' => 'resumes/'.$user->id.'/resume.txt',
            'original_name' => 'resume.txt',
            'mime_type' => 'text/plain',
            'size' => 80,
        ]);

        $this->actingAs($user)
            ->postJson(route('resume-builder.store'), $this->resumeData())
            ->assertCreated();

        $this->assertDatabaseHas('resumes', ['id' => $uploadedResume->id, 'title' => 'Uploaded resume']);
        $this->get(route('dashboard'))
            ->assertOk()
            ->assertDontSee('Create Your Professional Resume');
    }

    public function test_long_resume_pdf_flows_across_multiple_pages(): void
    {
        $user = User::factory()->create();
        $data = $this->resumeData();
        $data['personal_information']['name'] = 'Page Test';
        $description = str_repeat('Designed and delivered accessible product workflows with measurable improvements. ', 120);
        $data['work_experience'] = array_map(fn (int $index): array => [
            'job_title' => 'Product Designer '.$index,
            'company' => 'Test Studio',
            'employment_type' => 'Full-time',
            'location' => '',
            'start_date' => '2020-01',
            'end_date' => '2022-01',
            'current' => false,
            'responsibilities' => $description,
            'achievements' => [],
        ], range(1, 8));
        $document = $user->resumeBuilderDocuments()->create($data);

        $pdf = Pdf::loadView('resume-builder.pdf', [
            'document' => $document,
            'photoDataUri' => null,
        ])->setPaper('a4', 'portrait');
        $output = $pdf->output();

        $this->assertGreaterThan(1, $pdf->getDomPDF()->getCanvas()->get_page_count());

        $temporaryPath = tempnam(sys_get_temp_dir(), 'careerpilot-resume-');
        $path = $temporaryPath.'.pdf';
        rename($temporaryPath, $path);
        file_put_contents($path, $output);

        try {
            $text = app(ResumeAnalysisService::class)->extractTextFromFile($path, 'application/pdf');
            $this->assertStringContainsString('Page Test', $text);
            $this->assertStringContainsString('Product Designer 1', $text);
        } finally {
            unlink($path);
        }
    }

    public function test_ai_suggestions_are_reviewable_and_invalid_items_are_reported(): void
    {
        config(['services.gemini.key' => 'test-key']);
        $user = User::factory()->create();
        $document = $user->resumeBuilderDocuments()->create($this->resumeData());

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::sequence()
                ->push([
                    'candidates' => [[
                        'content' => ['parts' => [['text' => json_encode(['text' => 'A reviewed summary suggestion'])]]],
                    ]],
                ])
                ->push([
                    'candidates' => [[
                        'content' => ['parts' => [['text' => json_encode(['items' => 'not-an-array'])]]],
                    ]],
                ]),
        ]);

        $this->actingAs($user)
            ->postJson(route('resume-builder.ai', $document->id), ['action' => 'summary'])
            ->assertOk()
            ->assertJsonPath('suggestion.text', 'A reviewed summary suggestion');

        $this->postJson(route('resume-builder.ai', $document->id), ['action' => 'skills'])
            ->assertStatus(503)
            ->assertJsonPath('message', 'The AI response could not be read. Please try again.');
    }

    public function test_resume_builder_routes_require_authentication(): void
    {
        $this->get(route('resume-builder.create'))
            ->assertRedirect(route('login'));
    }

    private function resumeData(): array
    {
        return [
            'title' => 'My Resume',
            'template' => 'modern',
            'theme_color' => '#704CE3',
            'heading_color' => '#292044',
            'personal_information' => [
                'name' => '',
                'job_title' => '',
                'email' => '',
                'phone' => '',
                'location' => '',
                'linkedin' => '',
                'portfolio' => '',
                'summary' => '',
            ],
            'work_experience' => [],
            'education' => [],
            'skills' => [],
            'projects' => [],
            'certifications' => [],
            'languages' => [],
            'additional_sections' => [],
        ];
    }
}
