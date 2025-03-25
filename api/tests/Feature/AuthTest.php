<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register(): void
    {
        $request = $this->postJson('/api/v1/auth/register', [
            "name" => "Test",
            "email" => "teste@email.com",
            "password" => "12345678"
        ]);

        $request->assertStatus(201);
    }

    public function test_login(): void
    {
        $request = $this->postJson('/api/v1/auth/login', [
            "email" => "teste@email.com",
            "password" => "12345678"
        ]);

        $request->assertStatus(200);
    }
}
