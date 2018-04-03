<?php

use Faker\Generator as Faker;

$factory->define(\App\Task::class, function (Faker $faker) {
    return [
        'title'=>$faker->title(),
        'project_id'=>$faker->uuid,
        'completed'=>$faker->boolean
    ];
});
