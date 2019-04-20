<?php

namespace Tests\Feature;

use Tests\TestCase;

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
