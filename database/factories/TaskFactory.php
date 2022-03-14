<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sites;
use Faker\Generator as Faker;

$factory->define(Sites::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'project_id' => $faker->numberBetween(1,10),
        'title' => $faker->text(40),
        'price' => $faker->numberBetween(10, 50),
        'description' => $faker->realText(200),
        'length' => $faker->numberBetween(1, 10),
        'status' => true,
        'complete_status' => 'new',
        'apply_deadline' => \Carbon\Carbon::now()->addDays(2),
        'complete_deadline' => \Carbon\Carbon::now()->addDays(5)
    ];
});
