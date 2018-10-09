<?php

namespace Tests;

use App\User;

trait WithStubUser
{
    /**
     * @var \App\User
     */
    protected $user;

    public function createStubUser(array $data = [])
    {
        if ($data && is_array($data)) {
            $data = array_merge([
                'first_name' => 'User',
                'last_name' => 'Test',
                'email' => 'test-user-'.uniqid().'@example.com',
                'password' => '123456qwerty',
            ], $data);

            $this->user = User::create($data);

        } else {
            $this->user = factory(User::class)->create();
        }

        return $this->user;
    }

    public function deleteStubUser()
    {
        $this->user->forceDelete();
    }
}
