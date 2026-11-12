<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Http\Resources\ResumeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiResumeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(['data' => ResumeResource::collection($request->user()->resumes()->latest()->get())]);
    }

    public function store(ResumeRequest $request): JsonResponse
    {
        $file = $request->file('file');
        $path = $file->storeAs('resumes/' . $request->user()->id, uniqid() . '-' . $file->getClientOriginalName(), 'local');

        $resume = $request->user()->resumes()->create([
            'title' => $request->input('title', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)),
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'is_primary' => ! $request->user()->resumes()->exists(),
        ]);

        return response()->json(['message' => 'Resume uploaded', 'data' => new ResumeResource($resume)], 201);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $resume = $request->user()->resumes()->findOrFail($id);

        return response()->json(['data' => new ResumeResource($resume)]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $resume = $request->user()->resumes()->findOrFail($id);
        Storage::disk('local')->delete($resume->file_path);
        $resume->delete();

        return response()->json(['message' => 'Resume deleted']);
    }
}
