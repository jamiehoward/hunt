<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginPageCanBeAccessed()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function testValidCredentialsAreAccepted()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Login');
    }
}
