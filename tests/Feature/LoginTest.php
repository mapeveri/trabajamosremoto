<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /** test */
    public function it_visit_page_of_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    /** test */
    public function authenticated_to_a_user()
    {
        $user = factory('App\User')->create();

        $this->get('/login')->assertSee('Login');
        $credentials = [
            "email" => "user@mail.com",
            "password" => "secret"
        ];

        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/home');
        $this->assertCredentials($credentials);
    }

    /** @test */
    public function not_authenticate_to_a_user_with_credentials_invalid()
    {
        $user = factory('App\User')->create();

        $credentials = [
            "email" => "users@mail.com",
            "password" => "secret"
        ];

        $this->assertInvalidCredentials($credentials);
    }

    /** @test */
    public function the_email_is_required_for_authenticate()
    {
        $user = factory('App\User')->create();
        $credentials = [
            "email" => null,
            "password" => "secret"
        ];

        $response = $this->from('/login')->post('/login', $credentials);
        $response->assertRedirect('/login')->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);
    }

    /** @test */
    public function the_password_is_required_for_authenticate()
    {
        $user = factory('App\User')->create();
        $credentials = [
            "email" => "zaratedev@gmail.com",
            "password" => null
        ];

        $response = $this->from('/login')->post('/login', $credentials);
        $response->assertRedirect('/login')
            ->assertSessionHasErrors([
                'password' => 'The password field is required.',
            ]);
    }

    /** @test */
    public function a_user_can_logout()
    {
        $this->signIn(factory('App\User')->create());
        $response = $this->post('/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }

    /** @test */
    public function as_user_cannot_logout_when_not_authenticated()
    {
        $response = $this->post('/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
