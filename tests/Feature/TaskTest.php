<?php

namespace Tests\Feature;

use App\User;
use App\Task;

use Tests\TestCase;
use Tests\WithStubUser;
use Tests\WithStubTask;
use Tests\WithHeaders;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
    use DatabaseTransactions, WithStubUser, WithStubTask, WithHeaders;

    /**
     * test request
     * GET /api/tasks
     */
    public function tests_task_list_is_retrieved()
    {
        $headers = $this->headers;

        $payload = [];

        // retrieve task list
        $this->json('GET', '/api/tasks', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' =>
                    [ '*' =>
                        ['id', 'name', 'description', 'completed_at', 'user' =>
                            ['id', 'first_name', 'last_name', 'email']
                        ]
                    ],
                'links' => [],
                'meta' => []
            ]);
    }

    /**
     * test request
     * POST /api/tasks
     */
    public function tests_task_is_created()
    {
        $headers = $this->headers;

        $user = factory(User::class)->create();

        $payload = [
            'name' => 'Lorem ipsum',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'user_id' => $user->id
        ];

        $this->json('POST', '/api/tasks', $payload, $headers)
            ->assertStatus(201)
            ->assertJsonStructure([ 'data' =>
                ['id', 'name', 'description', 'user_id', 'completed_at']
            ]);
    }

    /**
     * test request
     * PUT /api/tasks/{task}
     */
    public function tests_task_is_updated()
    {
    //    $task = $this->task;
        $task = $this->createStubTask();

        $headers = $this->headers;

        $payload = [
            'name' => 'Ababagalamaga',
            'description' => 'Why do I have these kinds of concerns?'
        ];

        $this->json('PUT', '/api/tasks/'.$task->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([ 'data' =>
                ['id', 'name', 'description', 'user_id', 'completed_at']
            ]);

        $this->deleteStubTask();
    }

    /**
     * test request
     * PUT /api/tasks/{task}/comlete
     */
    public function tests_task_is_completed()
    {
    //    $task = $this->task;
        $task = $this->createStubTask();

        $headers = $this->headers;

        $payload = [];

        $this->json('PUT', '/api/tasks/'.$task->id.'/complete', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([ 'data' =>
                ['id', 'name', 'description', 'user_id', 'completed_at']
            ]);

        $completed_at = new \DateTime(Task::find($task->id)->completed_at);
        // check completed_at
        // date equals with now
        $this->assertEquals($completed_at->format('Y-m-d'), date('Y-m-d'));

        $this->deleteStubTask();
    }

    /**
     * test request
     * DELETE /api/tasks/{task}
     */
    public function tests_task_is_deleted()
    {
    //    $task = $this->task;
        $task = $this->createStubTask();

        $headers = $this->headers;

        $payload = [];

        $this->json('DELETE', '/api/tasks/'.$task->id, $payload, $headers)
            ->assertStatus(204);

        $task = Task::find($task->id);
        // task not found
        $this->assertNull($task);
    }
}
