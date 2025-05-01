<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    // TC001
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    // TC002
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    // TC003
    public function test_user_can_register_with_valid_data(): void
    {
        $response = $this->post('/register', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    // TC004
    public function test_registration_fails_with_existing_email(): void
    {
        User::factory()->create(['email' => 'john@example.com']);

        $response = $this->from('/register')->post('/register', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    // TC005
    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    // TC006
    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    // TC007
    public function test_password_reset_link_can_be_requested_with_valid_email(): void
    {
        $user = User::factory()->create(['email' => 'john@example.com']);

        $response = $this->post('/forgot-password', [
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHas('status', trans(Password::RESET_LINK_SENT));
    }

    // TC008
    public function test_password_reset_fails_with_invalid_email(): void
    {
        $response = $this->from('/forgot-password')->post('/forgot-password', [
            'email' => 'fake@example.com',
        ]);

        $response->assertRedirect('/forgot-password');
        $response->assertSessionHasErrors('email');
    }

    // TC010
    public function test_normal_user_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(403); // or use assertRedirect('/') if your app redirects unauthorized access
    }
}
