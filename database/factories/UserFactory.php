<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Profile;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'cpf'            => $faker->numerify('###.###.###-##'),
        'password'       => bcrypt('password'),
        'birth_date' => $faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
        'profile_id'     => Profile::first()->id ?? 1,
        'remember_token' => Str::random(10),
    ];
});
