<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationRequest;
use App\Http\Resources\JobApplicationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiJobApplicationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'data' => JobApplicationResource::collection($request->user()->jobApplications()->latest('applied_at')->get()),
        ]);
    }

    public function store(JobApplicationRequest $request): JsonResponse
    {
        $job = $request->user()->jobApplications()->create($request->validated());

        return response()->json(['message' => 'Job saved', 'data' => new JobApplicationResource($job)], 201);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $job = $request->user()->jobApplications()->findOrFail($id);

        return response()->json(['data' => new JobApplicationResource($job)]);
    }

    public function update(JobApplicationRequest $request, int $id): JsonResponse
    {
        $job = $request->user()->jobApplications()->findOrFail($id);
        $job->update($request->validated());

        return response()->json(['message' => 'Job updated', 'data' => new JobApplicationResource($job)]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $job = $request->user()->jobApplications()->findOrFail($id);
        $job->delete();

        return response()->json(['message' => 'Job deleted']);
    }
}
