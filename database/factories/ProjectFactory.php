<?php

use Faker\Generator as Faker;

$factory->define(\App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->title(),
        'thumbnail' => $faker->imageUrl(),
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
