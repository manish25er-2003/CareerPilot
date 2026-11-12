<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Models\Resume;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResumeController extends Controller
{
    public function index()
    {
        $resumes = Auth::user()->resumes()->latest()->get();

        return view('resumes.index', compact('resumes'));
    }

    public function store(ResumeRequest $request): RedirectResponse
    {
        $file = $request->file('file');
        $path = $file->storeAs('resumes/' . Auth::id(), uniqid() . '-' . $file->getClientOriginalName(), 'local');

        Auth::user()->resumes()->create([
            'title' => $request->input('title', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)),
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'is_primary' => ! Auth::user()->resumes()->exists(),
        ]);

        return redirect()->route('resumes.index')->with('success', 'Resume uploaded successfully.');
    }

    public function show(int $id)
    {
        $resume = Auth::user()->resumes()->findOrFail($id);

        return view('resumes.show', compact('resume'));
    }

    public function download(int $id): BinaryFileResponse
    {
        $resume = Auth::user()->resumes()->findOrFail($id);

        return response()->download(storage_path('app/' . $resume->file_path), $resume->original_name);
    }

    public function markPrimary(int $id): RedirectResponse
    {
        $user = Auth::user();
        $user->resumes()->update(['is_primary' => false]);
        $user->resumes()->where('id', $id)->update(['is_primary' => true]);

        return redirect()->route('resumes.index')->with('success', 'Primary resume updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $resume = Auth::user()->resumes()->findOrFail($id);

        if (Storage::disk('local')->exists($resume->file_path)) {
            Storage::disk('local')->delete($resume->file_path);
        }

        $resume->delete();

        return redirect()->route('resumes.index')->with('success', 'Resume deleted successfully.');
    }
}
