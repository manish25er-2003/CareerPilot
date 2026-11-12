<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
    public function index(): View
    {
        $jobs = Auth::user()->jobApplications()->latest('applied_at')->get();

        return view('jobs.index', compact('jobs'));
    }

    public function store(JobApplicationRequest $request): RedirectResponse
    {
        Auth::user()->jobApplications()->create($request->validated());

        return redirect()->route('jobs.index')->with('success', 'Job application saved successfully.');
    }

    public function update(JobApplicationRequest $request, int $id): RedirectResponse
    {
        $job = Auth::user()->jobApplications()->findOrFail($id);
        $job->update($request->validated());

        return redirect()->route('jobs.index')->with('success', 'Job application updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $job = Auth::user()->jobApplications()->findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job application removed.');
    }
}
