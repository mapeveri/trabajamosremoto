<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    /**
     * Test profile user profile not logged
     *
     * @return void
     */
    public function testProfileUserNotLogin()
    {
        $user = \App\User::all()->first();
        $response = $this->get('/profile');

        $response->assertStatus(404);
    }

    /**
     * Test profile user logged
     *
     * @return void
     */
    public function testProfileUserLogin()
    {
        $user = \App\User::all()->first();
        $this->signIn($user);
        $response = $this->get('/profile');

        $response->assertStatus(200);
    }

    /**
     * Test profile public
     *
     * @return void
     */
    public function testProfileUserPublic()
    {
        $user = \App\User::all()->first();
        $response = $this->get('/profile/' . $user->username);

        $response->assertStatus(200);
    }

    /**
     * Test profile form edit user not logged
     *
     * @return void
     */
    public function testProfileUserNotLoggedEdit()
    {
        $user = \App\User::all()->first();
        $response = $this->get('/profile/edit');

        $response->assertStatus(302);
    }

    /**
     * Test profile form edit user logged
     *
     * @return void
     */
    public function testProfileUserLoginEdit()
    {
        $user = \App\User::all()->first();
        $this->signIn($user);
        $response = $this->get('/profile/edit');

        $response->assertStatus(200);
    }

    /**
     * Test profile post to edit user logged
     *
     * @return void
     */
    public function testProfileUserLoginEditPost()
    {
        $user = \App\User::all()->first();
        $this->signIn($user);
        $credentials = [
            "location" => "test",
        ];
        $response = $this->put('/profile/edit', $credentials);

        $response->assertStatus(302);
    }
}
