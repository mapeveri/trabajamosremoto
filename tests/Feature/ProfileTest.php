<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
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
}
