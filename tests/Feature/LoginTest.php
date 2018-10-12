<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Tests\WithHeaders;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use WithHeaders;

    /**
     * test request POST /api/login
     * without credentials
     */
    public function test_requires_email_and_password()
    {
        $headers = $this->headers;

        $this->json('POST', '/api/login', [], $headers)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                 ]
            ]);
    }

    /**
     * test request POST /api/login
     * with wrong credentials
     */
    public function test_user_logins_failed()
    {
        $user = factory(User::class)->create([
            'email' => 'testuser@site.com',
            'password' => bcrypt('123qwe0'),
        ]);

        $headers = $this->headers;

        $payload = ['email' => 'testuser@site.com', 'password' => 'xxxxxxxx'];

        $this->json('POST', '/api/login', $payload, $headers)
            ->assertStatus(422)
            ->assertJson([
                'error' => 'These credentials do not match our records.'
            ]);
    }

    /**
     * test request POST /api/login
     * with right credentials
     */
    public function test_user_logins_successfully()
    {
        $user = factory(User::class)->create([
            'email' => 'testuser@site.com',
            'password' => bcrypt('123qwe0'),
        ]);

        $headers = $this->headers;

        $payload = ['email' => 'testuser@site.com', 'password' => '123qwe0'];

        $this->json('POST', '/api/login', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [ 'id', 'first_name', 'last_name', 'email', 'api_token', 'created_at', 'updated_at' ]
            ]);
    }
}
