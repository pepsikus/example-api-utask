<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Tests\WithStubUser;
use Tests\WithHeaders;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions, WithStubUser, WithHeaders;

    /**
     * test request
     * GET /api/users
     */
    public function test_user_list_is_retrieved()
    {
        $user = $this->createStubUser();
        $token = $user->generateToken();

        $headers = $this->headers /*+ ['Authorization' => "Bearer $token"]*/;

        $payload = [];

        // retrieve user list
        $this->actingAs($user, 'api')->json('GET', '/api/users', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' =>
                    [ '*' => ['id', 'first_name', 'last_name', 'email'] ],
                'links' => [],
                'meta' => []
            ]);
    }

    /**
     * test request
     * POST /api/users
     */
    public function test_user_is_created()
    {
        $user = $this->createStubUser();
        $token = $user->generateToken();

        $headers = $this->headers/* + ['Authorization' => "Bearer $token"]*/;

        $payload = [
            'first_name' => 'Mikle',
            'last_name' => 'Jackson',
            'email' => 'miklej@site.com',
            'password' => 'ahahahha'
        ];

        $this->actingAs($user, 'api')->json('POST', '/api/users', $payload, $headers)
            ->assertStatus(201)
            ->assertJsonStructure([ 'data' =>
                ['id', 'first_name', 'last_name', 'email']
            ]);
    }

    /**
     * test requests
     * GET /api/users/{user}
     * GET /api/users/{user}/tasks
     */
    public function test_user_and_user_tasks_is_retrieved()
    {
        $user = $this->createStubUser();
        $token = $user->generateToken();

        $headers = $this->headers/* + ['Authorization' => "Bearer $token"]*/;

        $payload = [];

        $this->actingAs($user, 'api')->json('GET', '/api/users/'.$user->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([ 'data' =>
                ['id', 'first_name', 'last_name', 'email']
            ]);

        // retrieve user tasks
        $this->actingAs($user, 'api')->json('GET', '/api/users/'.$user->id.'/tasks', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([ 'data' =>
                [ '*' => ['id', 'name', 'description', 'completed_at'] ]
            ]);

        $this->deleteStubUser();
    }

    /**
     * test request
     * PUT /api/users/{user}
     */
    public function test_user_is_updated()
    {
        $user = $this->createStubUser();
        $token = $user->generateToken();

        $headers = $this->headers/* + ['Authorization' => "Bearer $token"]*/;

        $payload = [
            'first_name' => 'John',
            'last_name' => 'Silver'
        ];

        $this->actingAs($user, 'api')->json('PUT', '/api/users/'.$user->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([ 'data' =>
                ['id', 'first_name', 'last_name', 'email']
            ]);

        $this->deleteStubUser();
    }

    /**
     * test request
     * PUT /api/users/{user}/verify_email
     */
    public function test_user_email_is_verified()
    {
        $user = $this->createStubUser();
        $token = $user->generateToken();

        $headers = $this->headers/* + ['Authorization' => "Bearer $token"]*/;

        $payload = [];

        $this->actingAs($user, 'api')->json('PUT', '/api/users/'.$user->id.'/verify_email', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([ 'data' =>
                ['id', 'first_name', 'last_name', 'email']
            ]);

        $email_verified_at = new \DateTime(User::find($user->id)->email_verified_at);
        // check email_verified_at
        // date equals with now
        $this->assertEquals($email_verified_at->format('Y-m-d'), date('Y-m-d'));

        $this->deleteStubUser();
    }

    /**
     * test request
     * DELETE /api/users/{user}
     */
    public function test_user_is_deleted()
    {
        $user = $this->createStubUser();
        $token = $user->generateToken();

        $headers = $this->headers/* + ['Authorization' => "Bearer $token"]*/;

        $payload = [];

        $this->actingAs($user, 'api')->json('DELETE', '/api/users/'.$user->id, $payload, $headers)
            ->assertStatus(204);

        $user = User::find($user->id);
        // user not found
        $this->assertNull($user);
    }
}
