<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class GoogleAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_google_login_redirects_to_google_provider(): void
    {
        Socialite::shouldReceive('driver')
            ->with('google')
            ->andReturn(new class
            {
                public function redirect()
                {
                    return redirect('https://accounts.google.com/o/oauth2/auth');
                }
            });

        $response = $this->get(route('auth.google'));

        $response->assertRedirect('https://accounts.google.com/o/oauth2/auth');
    }
}
