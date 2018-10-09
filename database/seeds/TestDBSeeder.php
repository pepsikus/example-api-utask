<?php

use Illuminate\Database\Seeder;

class TestDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creates Users and Tasks
        $this->command->info("Creates Users with a Tasks...");
        factory(App\User::class, 5)
           ->create()
           ->each(function ($u) {
                factory(App\Task::class, 3)->create(['user_id' => $u->id]);
            }
        );
        // Creates user with no tasks
        $this->command->info("Creates Users with no Tasks...");
        factory(App\User::class, 10)->create();
    }
}
