<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        $profile = Auth::user()->profile()->first();
        $skills = $profile ? $profile->skills()->orderBy('category')->get() : collect();

        return view('skills.index', compact('skills'));
    }

    public function store(SkillRequest $request): RedirectResponse
    {
        $profile = Auth::user()->profile()->firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $skill = Skill::firstOrCreate([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
        ], [
            'description' => $request->input('description'),
        ]);

        $profile->skills()->syncWithoutDetaching([
            $skill->id => ['proficiency_level' => $request->input('proficiency_level', 'Beginner')],
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill added successfully.');
    }

    public function update(SkillRequest $request, int $id): RedirectResponse
    {
        $profile = Auth::user()->profile()->firstOrFail();
        $profile->skills()->updateExistingPivot($id, [
            'proficiency_level' => $request->input('proficiency_level', 'Beginner'),
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $profile = Auth::user()->profile()->firstOrFail();
        $profile->skills()->detach($id);

        return redirect()->route('skills.index')->with('success', 'Skill removed successfully.');
    }
}
