<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeBuilderDocumentRequest;
use App\Models\ResumeBuilderDocument;
use App\Services\Ai\ResumeBuilderAiException;
use App\Services\Ai\ResumeBuilderAiService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class ResumeBuilderController extends Controller
{
    public function index(): View
    {
        $documents = ResumeBuilderDocument::query()
            ->where('user_id', Auth::id())
            ->latest('updated_at')
            ->get();

        return view('resume-builder.index', compact('documents'));
    }

    public function create(): View
    {
        $user = Auth::user();
        $profile = $user->profile()->with('skills')->first();
        $initialData = $this->emptyDocumentData();
        $initialData['personal_information'] = [
            ...$initialData['personal_information'],
            'name' => $profile?->full_name ?: $user->name,
            'email' => $user->email,
            'job_title' => $profile?->professional_headline ?? '',
            'phone' => $profile?->phone ?? '',
            'location' => $profile?->location ?? '',
            'linkedin' => $profile?->linkedin_url ?? '',
            'portfolio' => $profile?->portfolio_url ?? '',
            'summary' => $profile?->bio ?? '',
        ];
        $initialData['skills'] = $profile?->skills
            ->map(fn ($skill): array => [
                'name' => $skill->name,
                'category' => '',
                'proficiency' => $skill->pivot->proficiency_level ?? '',
            ])
            ->values()
            ->all() ?? [];

        $document = null;
        $photoUrl = null;

        return view('resume-builder.editor', compact('document', 'initialData', 'photoUrl'));
    }

    public function store(ResumeBuilderDocumentRequest $request): JsonResponse
    {
        $document = ResumeBuilderDocument::create([
            ...$request->validated(),
            'user_id' => Auth::id(),
        ]);

        return response()->json($this->documentResponse($document), 201);
    }

    public function edit(int $id): View
    {
        $document = $this->ownedDocument($id);
        $initialData = $document->only([
            'title',
            'template',
            'theme_color',
            'heading_color',
            'personal_information',
            'work_experience',
            'education',
            'skills',
            'projects',
            'certifications',
            'languages',
            'additional_sections',
        ]);
        $photoUrl = $document->profile_photo_path
            ? route('resume-builder.photo', $document->id)
            : null;

        return view('resume-builder.editor', compact('document', 'initialData', 'photoUrl'));
    }

    public function update(ResumeBuilderDocumentRequest $request, int $id): JsonResponse
    {
        $document = $this->ownedDocument($id);
        $document->fill($request->validated())->save();

        return response()->json($this->documentResponse($document->fresh()));
    }

    public function preview(int $id): View
    {
        $document = $this->ownedDocument($id);
        $photoUrl = $document->profile_photo_path
            ? route('resume-builder.photo', $document->id)
            : null;

        return view('resume-builder.preview', compact('document', 'photoUrl'));
    }

    public function download(int $id): Response
    {
        $document = $this->ownedDocument($id);

        $pdf = Pdf::loadView('resume-builder.pdf', [
            'document' => $document,
            'photoDataUri' => $this->photoDataUri($document),
        ])->setPaper('a4', 'portrait');

        return $pdf->download(Str::slug($document->title ?: 'resume').'.pdf');
    }

    public function uploadPhoto(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'profile_photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
        $document = $this->ownedDocument($id);

        if ($document->profile_photo_path) {
            Storage::disk('local')->delete($document->profile_photo_path);
        }

        $path = $request->file('profile_photo')->store(
            'resume-builder/'.$document->user_id.'/'.$document->id,
            'local'
        );
        $document->forceFill(['profile_photo_path' => $path])->save();

        return response()->json([
            'photo_url' => route('resume-builder.photo', $document->id),
        ]);
    }

    public function photo(int $id): BinaryFileResponse
    {
        $document = $this->ownedDocument($id);

        abort_unless(
            $document->profile_photo_path
                && Storage::disk('local')->exists($document->profile_photo_path),
            404
        );

        return response()->file(Storage::disk('local')->path($document->profile_photo_path), [
            'Cache-Control' => 'private, max-age=300',
        ]);
    }

    public function suggest(Request $request, int $id, ResumeBuilderAiService $aiService): JsonResponse
    {
        $document = $this->ownedDocument($id);
        $validated = $request->validate([
            'action' => ['required', 'in:summary,improve_description,achievements,skills,grammar,tailor'],
            'text' => ['nullable', 'string', 'max:6000'],
            'job_description' => ['nullable', 'string', 'max:12000'],
        ]);

        if (in_array($validated['action'], ['improve_description', 'achievements', 'grammar'], true)
            && blank($validated['text'] ?? null)) {
            throw ValidationException::withMessages([
                'text' => 'Add the information you want the AI to improve first.',
            ]);
        }

        if ($validated['action'] === 'tailor' && blank($validated['job_description'] ?? null)) {
            throw ValidationException::withMessages([
                'job_description' => 'Add a target job description before tailoring your resume.',
            ]);
        }

        try {
            $suggestion = $aiService->suggest(
                $document,
                $validated['action'],
                $validated['text'] ?? null,
                $validated['job_description'] ?? null,
            );
        } catch (ResumeBuilderAiException $exception) {
            return response()->json(['message' => $exception->getMessage()], 503);
        }

        return response()->json(['suggestion' => $suggestion]);
    }

    public function destroy(int $id): JsonResponse
    {
        $document = $this->ownedDocument($id);

        if ($document->profile_photo_path) {
            Storage::disk('local')->delete($document->profile_photo_path);
        }

        $document->delete();

        return response()->json(['message' => 'Resume deleted.']);
    }

    private function ownedDocument(int $id): ResumeBuilderDocument
    {
        return ResumeBuilderDocument::query()
            ->where('user_id', Auth::id())
            ->findOrFail($id);
    }

    private function documentResponse(ResumeBuilderDocument $document): array
    {
        return [
            'id' => $document->id,
            'title' => $document->title,
            'updated_at' => $document->updated_at?->toIso8601String(),
            'edit_url' => route('resume-builder.edit', $document->id),
            'update_url' => route('resume-builder.update', $document->id),
            'preview_url' => route('resume-builder.preview', $document->id),
            'download_url' => route('resume-builder.download', $document->id),
            'photo_upload_url' => route('resume-builder.photo.upload', $document->id),
            'ai_url' => route('resume-builder.ai', $document->id),
            'delete_url' => route('resume-builder.destroy', $document->id),
            'photo_url' => $document->profile_photo_path
                ? route('resume-builder.photo', $document->id)
                : null,
        ];
    }

    private function photoDataUri(ResumeBuilderDocument $document): ?string
    {
        if (! $document->profile_photo_path || ! Storage::disk('local')->exists($document->profile_photo_path)) {
            return null;
        }

        $mime = mime_content_type(Storage::disk('local')->path($document->profile_photo_path));
        $contents = Storage::disk('local')->get($document->profile_photo_path);

        return 'data:'.$mime.';base64,'.base64_encode($contents);
    }

    private function emptyDocumentData(): array
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
