<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Emutoday\User::class, function (Faker\Generator $faker) {
  return [
    'name' => $faker->name,
    'email' => $faker->safeEmail,
    'password' => bcrypt(str_random(10)),
    'remember_token' => str_random(10),
  ];
});

$factory->define(Emutoday\Event::class, function (Faker\Generator $faker) {
  return [
    // 'author_id' =>
  ];
});

$factory->define(Emutoday\Email::class, function (Faker\Generator $faker) {
  return [
    'title' => $faker->name,
    'frequency' => $faker->randomDigitNotNull,
    'send_at' => $faker->dateTimeThisMonth,
    'end_at' => $faker->dateTimeThisMonth,
  ];
});
