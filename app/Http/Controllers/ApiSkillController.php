<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiSkillController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $skills = $request->user()->profile()->first()?->skills()->get() ?? collect();

        return response()->json(['data' => SkillResource::collection($skills)]);
    }

    public function store(SkillRequest $request): JsonResponse
    {
        $profile = $request->user()->profile()->firstOrCreate(['user_id' => $request->user()->id]);
        $skill = Skill::firstOrCreate([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
        ]);

        $profile->skills()->syncWithoutDetaching([
            $skill->id => ['proficiency_level' => $request->input('proficiency_level', 'Beginner')],
        ]);

        return response()->json(['message' => 'Skill created', 'data' => new SkillResource($skill)], 201);
    }

    public function update(SkillRequest $request, int $id): JsonResponse
    {
        $profile = $request->user()->profile()->firstOrFail();
        $profile->skills()->updateExistingPivot($id, ['proficiency_level' => $request->input('proficiency_level', 'Beginner')]);

        return response()->json(['message' => 'Skill updated']);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $profile = $request->user()->profile()->firstOrFail();
        $profile->skills()->detach($id);

        return response()->json(['message' => 'Skill deleted']);
    }
}
