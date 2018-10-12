<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Tests\WithHeaders;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use WithHeaders;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_test_wrong_URI()
    {
        $user = request()->user() ?? factory(User::class)->create();
        $token = $user->generateToken();

        $headers = $this->headers + ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api', [], $headers);

        $response->assertStatus(404)
            ->assertJson([
                'error' => 'Resource not found'
            ]);
    }
}
