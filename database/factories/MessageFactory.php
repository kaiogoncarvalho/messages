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

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

$factory->define(
    App\Models\Message::class,
    function (Faker\Generator $faker) {
        $user = factory('App\Models\User')->create();
        return [
            'subject'         => $faker->text,
            'content'         => $faker->text,
            'user_id'         => $user->id,
            'start_date'      => $faker->dateTime(),
            'expiration_date' => $faker->dateTime()
        ];
    }
);
