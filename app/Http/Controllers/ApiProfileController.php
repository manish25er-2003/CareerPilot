<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiProfileController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $profile = $request->user()->profile()->firstOrCreate(['user_id' => $request->user()->id]);

        return response()->json(['data' => new ProfileResource($profile)]);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => ['nullable', 'string', 'max:150'],
            'professional_headline' => ['nullable', 'string', 'max:150'],
            'location' => ['nullable', 'string', 'max:120'],
            'education' => ['nullable', 'string', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:60'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'linkedin_url' => ['nullable', 'url'],
            'github_url' => ['nullable', 'url'],
            'portfolio_url' => ['nullable', 'url'],
        ]);

        $profile = $request->user()->profile()->firstOrCreate(['user_id' => $request->user()->id]);
        $profile->fill($validated);
        $profile->profile_score = 80;
        $profile->save();

        return response()->json(['message' => 'Profile updated', 'data' => new ProfileResource($profile)], 200);
    }
}
