<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'user_id' => 5,
        'name' => $faker->text(100),
        'speakers' => random_int(1,4),
        'tasks_per_speaker' => 2,
        'minutes_per_tasks' => 3,
        'budget' => $faker->randomFloat(3,0,10.0),
        'subject' => 'Test'
    ];
});
