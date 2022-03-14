php artisan db:seed<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'avatar' => '/storage/avatars/1/avatar.jpg',
        'token' => str_replace(['=', '==', '+', '/'], '', base64_encode(random_bytes(32))),
        'voice' => 'Adult',
        'main_language' => 136,
        'main_language_level' => 3,
        'country' => 191,
        'gender' => 'Male',
        'current_location' => $faker->country,
        'paypal' => $faker->unique()->safeEmail,
        'remember_token' => Str::random(10),
    ];
});
