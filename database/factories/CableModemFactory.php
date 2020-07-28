<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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

$factory->define(\App\CableModem::class, function (Faker $faker) {
    return [
        'vsi_model' => $faker->sentence,
        'vsi_vendor' => $faker->sentence,
        'modem_macaddr' => $faker->macAddress,
        'ipaddr' => $faker->ipv4,
        'vsi_swver' => $faker->sentence,
    ];
});

