<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        return view('profile.index', compact('user', 'profile'));
    }

    public function edit(): View
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'full_name' => ['nullable', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:50'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'professional_headline' => ['nullable', 'string', 'max:150'],
            'location' => ['nullable', 'string', 'max:120'],
            'education' => ['nullable', 'string', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:60'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
        ]);

        if ($request->has('name')) {
            $user->fill(['name' => $validated['name']]);
        }

        if ($request->has('email')) {
            $previousEmail = $user->email;
            $newEmail = $validated['email'];
            $user->email = $newEmail;
            $user->email_verified_at = $previousEmail === $newEmail ? $user->email_verified_at : null;
        }

        $user->save();

        $profileData = collect($validated)->except(['name', 'email'])->all();
        $profile = $user->profile()->firstOrNew(['user_id' => $user->id]);

        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image && Storage::disk('public')->exists($profile->profile_image)) {
                Storage::disk('public')->delete($profile->profile_image);
            }

            $profileData['profile_image'] = $request->file('profile_image')->store('profile-images', 'public');
        }

        $profile->fill($profileData);
        $profile->profile_score = $this->calculateProfileScore($profile);
        $profile->save();

        return redirect()->route('profile.index')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function calculateProfileScore(Profile $profile): int
    {
        $fields = [
            'full_name',
            'phone',
            'professional_headline',
            'location',
            'education',
            'experience_years',
            'bio',
            'linkedin_url',
            'github_url',
            'portfolio_url',
            'profile_image',
        ];

        $filled = 0;
        foreach ($fields as $field) {
            if (! empty($profile->{$field})) {
                $filled++;
            }
        }

        return (int) round(($filled / count($fields)) * 100);
    }
}
