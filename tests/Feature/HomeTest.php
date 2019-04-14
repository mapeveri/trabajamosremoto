<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    /**
     * Test home page
     *
     * @return void
     */
    public function testHomePath()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
