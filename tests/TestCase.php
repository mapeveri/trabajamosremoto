<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BaseTestCase
{
    use DatabaseTransactions, CreatesApplication;

    protected function signIn($user = null)
    {
        $user = $user ?: factory('App\User')->create();
        $this->actingAs($user);
        return $this;
    }

    public function setUp()
    {
        parent::setUp();
        $this->prepareForTests();
    }
}
