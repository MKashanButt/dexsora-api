<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_login_with_valid_credentials_and_gets_sanctum_token_cookie(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            "company" => "Acme Inc"
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['user' => ['id', 'name', 'email']]);

        $cookie = $response->headers->getCookies()[0] ?? null;

        $this->assertNotNull($cookie, 'No cookie returned');
        $this->assertEquals('sanctum_token', $cookie->getName());
        $this->assertNotEmpty($cookie->getValue());
    }
}
