<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => '1',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('login', absolute: false));
    }

    public function test_new_users_get_default_profile_and_settings_records(): void
    {
        $this->post('/register', [
            'name' => 'Profile User',
            'email' => 'profile@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => '1',
        ]);

        $user = User::where('email', 'profile@example.com')->first();

        $this->assertNotNull($user);
        $this->assertTrue($user->profile()->exists());
        $this->assertTrue($user->settings()->exists());
        $this->assertGuest();
    }
}
