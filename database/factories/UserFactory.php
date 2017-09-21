<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->userName,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'address' => $faker->unique()->address,
        'city' => $faker->unique()->city,
        'state' => 'UT',
        'zip' => $faker->unique()->numberBetween(10000,99999),
        'phone' => $faker->unique()->phoneNumber,
    ];
});
