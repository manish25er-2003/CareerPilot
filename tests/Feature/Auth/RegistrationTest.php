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

    public function test_registration_rejects_an_invalid_email_and_preserves_safe_input(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'New User',
            'email' => 'not-an-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => '1',
        ]);

        $response->assertRedirect('/register')
            ->assertSessionHasErrors(['email'])
            ->assertSessionHas('_old_input.name', 'New User')
            ->assertSessionHas('_old_input.email', 'not-an-email')
            ->assertSessionMissing('_old_input.password')
            ->assertSessionMissing('_old_input.password_confirmation');
        $this->assertGuest();
    }

    public function test_registration_rejects_an_existing_email(): void
    {
        $user = User::factory()->create();

        $response = $this->from('/register')->post('/register', [
            'name' => 'Duplicate User',
            'email' => $user->email,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => '1',
        ]);

        $response->assertRedirect('/register')
            ->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('users', 1);
        $this->assertGuest();
    }

    public function test_registration_requires_all_fields(): void
    {
        $response = $this->from('/register')->post('/register', []);

        $response->assertRedirect('/register')
            ->assertSessionHasErrors(['name', 'email', 'password', 'password_confirmation', 'terms'])
            ->assertSessionMissing('_old_input.password')
            ->assertSessionMissing('_old_input.password_confirmation');
        $this->assertGuest();
    }

    public function test_registration_rejects_mismatched_password_confirmation(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'New User',
            'email' => 'new-user@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different-password',
            'terms' => '1',
        ]);

        $response->assertRedirect('/register')
            ->assertSessionHasErrors(['password_confirmation'])
            ->assertSessionHas('_old_input.email', 'new-user@example.com')
            ->assertSessionMissing('_old_input.password')
            ->assertSessionMissing('_old_input.password_confirmation');
        $this->assertGuest();
    }

    public function test_registration_rejects_a_password_below_the_minimum_length(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'New User',
            'email' => 'new-user@example.com',
            'password' => 'short',
            'password_confirmation' => 'short',
            'terms' => '1',
        ]);

        $response->assertRedirect('/register')
            ->assertSessionHasErrors(['password'])
            ->assertSessionMissing('_old_input.password')
            ->assertSessionMissing('_old_input.password_confirmation');
        $this->assertGuest();
    }
}
