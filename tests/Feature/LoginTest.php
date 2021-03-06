<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class LoginTest extends TestCase
{
    public function testVisitPageLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function testAuthenticatedUser()
    {
        $user = \App\User::all()->first();

        $this->get('/login')->assertSee('Login');
        $credentials = [
            "email" => $user->email,
            "password" => 'secret'
        ];

        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/');
        $this->assertCredentials($credentials);
    }

    public function testNotAuthenticateUserCredentialsInvalid()
    {
        $credentials = [
            "email" => "users@mail.com",
            "password" => "secrett"
        ];

        $this->assertInvalidCredentials($credentials);
    }

    public function testEmailRequiredForAuthenticate()
    {
        $credentials = [
            "email" => null,
            "password" => "secret"
        ];

        $response = $this->from('/login')->post('/login', $credentials);
        $response->assertRedirect('/login')->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);
    }

    public function testPasswordRequiredForAuthenticate()
    {
        $credentials = [
            "email" => "zaratedev@gmail.com",
            "password" => null
        ];

        $response = $this->from('/login')->post('/login', $credentials);
        $response->assertRedirect('/login')->assertSessionHasErrors([
            'password' => 'The password field is required.',
            ]);
    }

    public function testUserCanLogout()
    {
        $this->signIn(factory('App\User')->create());
        $response = $this->post('/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function testUserCannotLogoutWhenNotAuthenticated()
    {
        $response = $this->post('/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
