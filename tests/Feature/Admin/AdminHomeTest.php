<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminHomeTest extends TestCase
{
    /**
     * Test admin page without login
     *
     * @return void
     */
    public function testAdminHomeWithoutLogin()
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
    }

    /**
     * Test admin page login like simple user
     *
     * @return void
     */
    public function testAdminHomeLoginSimpleUser()
    {
        $user = \App\User::where('is_admin', false)->first();
        $this->signIn($user);
        $response = $this->get('/admin');

        $response->assertStatus(302);
    }

    /**
     * Test admin page login admin user
     *
     * @return void
     */
    public function testAdminHomeLoginAdminUser()
    {
        $user = \App\User::where('is_admin', true)->first();
        $this->signIn($user);
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }
}
