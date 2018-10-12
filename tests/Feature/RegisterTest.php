<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Tests\WithHeaders;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use WithHeaders;

    /**
     * test request POST /api/register
     * without credentials
     */
    public function test_requires_email_and_password_and_name()
    {
        $headers = $this->headers;

        $this->json('POST', 'api/register', [], $headers)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'first_name' => ['The first name field is required.'],
                    'last_name' => ['The last name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                 ]
            ]);
    }

    /**
     * test request POST /api/register
     * without password confirmation
     */
    public function test_requires_password_confirmation()
    {
        $headers = $this->headers;

        $payload = [
            'first_name' => 'Mikle',
            'last_name' => 'Jackson',
            'email' => 'testuser@site.com',
            'password' => '123qwe0'
        ];

        $this->json('POST', 'api/register', $payload, $headers)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => ['The password confirmation does not match.']
                 ]
            ]);
    }

    /**
     * test request POST /api/register
     * with right data
     */
    public function test_user_register_successfully()
    {
        $headers = $this->headers;

        $payload = [
            'first_name' => 'Mikle',
            'last_name' => 'Jackson',
            'email' => 'testuser@site.com',
            'password' => '123qwe0',
            'password_confirmation' => '123qwe0'
        ];

        $this->json('POST', 'api/register', $payload, $headers)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [ 'id', 'first_name', 'last_name', 'email', 'api_token', 'created_at', 'updated_at' ]
            ]);
    }
}
