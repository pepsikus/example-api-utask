<?php

namespace Tests\Feature;

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
        $response = $this->json('GET', '/api', [], $this->headers);

        $response->assertStatus(404)
            ->assertJson([
                'error' => 'Resource not found'
            ]);
    }
}
