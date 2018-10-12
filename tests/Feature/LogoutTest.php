<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Tests\WithHeaders;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LogoutTest extends TestCase
{
    use WithHeaders;

    /**
     * test request POST /api/logout
     * and check user api_tocken
     */
    public function test_user_is_loggedout_properly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = $this->headers + ['Authorization' => "Bearer $token"];

        $this->json('post', '/api/logout', [], $headers)
            ->assertStatus(200);

        $user = User::find($user->id);

        $this->assertNull($user->api_token);
    }
}
