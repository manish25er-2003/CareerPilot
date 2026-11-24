<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login')
            ->assertSessionHasErrors([
                'login' => 'The email or password you entered is incorrect. Please try again.',
            ])
            ->assertSessionHas('_old_input.email', $user->email)
            ->assertSessionMissing('_old_input.password');
    }

    public function test_users_can_not_authenticate_with_an_unknown_email(): void
    {
        $email = 'unknown@example.com';

        $response = $this->from('/login')->post('/login', [
            'email' => $email,
            'password' => 'incorrect-password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login')
            ->assertSessionHasErrors([
                'login' => 'The email or password you entered is incorrect. Please try again.',
            ])
            ->assertSessionHas('_old_input.email', $email)
            ->assertSessionMissing('_old_input.password');
    }

    public function test_login_requires_email_and_password(): void
    {
        $response = $this->from('/login')->post('/login', []);

        $response->assertRedirect('/login')
            ->assertSessionHasErrors(['email', 'password'])
            ->assertSessionMissing('_old_input.password');
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
