<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(): RedirectResponse
    {
        try {
            $socialiteUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors([
                'google' => 'Unable to sign in with Google right now. Please try again.',
            ]);
        }

        $email = trim((string) $socialiteUser->getEmail());

        if ($email === '') {
            return redirect()->route('login')->withErrors([
                'google' => 'Google account email is required to continue.',
            ]);
        }

        $user = User::where('google_id', $socialiteUser->getId())->first()
            ?? User::where('email', $email)->first();

        if (! $user) {
            $user = User::create([
                'name' => $socialiteUser->getName() ?: 'Google User',
                'email' => $email,
                'password' => Hash::make(Str::random(24)),
                'google_id' => $socialiteUser->getId(),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }

        if (empty($user->google_id)) {
            $user->forceFill(['google_id' => $socialiteUser->getId()])->save();
        }

        if ($user->email !== $email) {
            $user->forceFill(['email' => $email])->save();
        }

        if (! $user->email_verified_at) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        $user->profile()->firstOrCreate([
            'user_id' => $user->id,
        ], [
            'full_name' => $user->name,
            'professional_headline' => 'Career growth ready',
            'profile_score' => 10,
        ]);

        if ($socialiteUser->getAvatar()) {
            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                ['profile_image' => $socialiteUser->getAvatar()]
            );
        }

        $user->settings()->firstOrCreate([
            'user_id' => $user->id,
        ], [
            'theme' => 'light',
            'notification_email' => true,
            'interview_reminders' => true,
            'job_alerts' => true,
            'timezone' => 'UTC',
            'account_status' => 'active',
        ]);

        Auth::login($user, true);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
