<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'user_id' => function ($user = []) {
            if ($user && is_array($user) && array_key_exists("user_id", $user)) {
                return $user["user_id"];
            } else {
                return factory(App\User::class)->create()->id;
            }
        },
        'completed_at' => null,
    ];
});
