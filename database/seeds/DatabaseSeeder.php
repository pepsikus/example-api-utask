<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
