<?php

namespace Tests;

use App\Task;
use App\User;

trait WithStubTask
{
    /**
     * @var \App\Task
     */
    protected $task;

    public function createStubTask(array $data = [])
    {
        if ($data && is_array($data)) {
            $data = array_merge([
                'name' => 'bla-bla-bla',
                'description' => 'Test bla-bla-bla',
            ], $data);

            if (array_key_exists('user_id') && $data['user_id']) {
                $user = User::find($data['user_id']);

                if (!$user) {
                    $user = factory(User::class)->create();
                }

                $data['user_id'] = $user->id;

            } else {
                $user = factory(User::class)->create();

                $data['user_id'] = $user->id;
            }

            $this->task = Task::create($data);

        } else {
        //    $this->task = factory(Task::class)->create();
            // to prevent ErrorException: Object of class Closure could not be converted to string
            $this->task = factory(Task::class)->create(['user_id' => factory(User::class)->create()->id]);
        }

        return $this->task;
    }

    public function deleteStubTask()
    {
        $this->task->forceDelete();
    }
}
