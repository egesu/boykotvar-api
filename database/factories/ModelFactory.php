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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\tr_TR\Person($faker));
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password,
    ];
});

$factory->define(App\Boycott::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(rand(5, 100)),
        'description' => $faker->text(rand(50, 10000)),
        'created_by_id' => function() {
            return App\User::inRandomOrder()->first()->id;
        },
    ];
});

$factory->define(App\BoycottUser::class, function (Faker\Generator $faker) {
    return [
        'boycott_id' => function() {
            return App\Boycott::inRandomOrder()->first()->id;
        },
        'user_id' => function() {
            return App\User::inRandomOrder()->first()->id;
        },
    ];
});

$factory->define(App\BoycottPost::class, function (Faker\Generator $faker) {
    return [
        'boycott_id' => function() {
            return App\Boycott::inRandomOrder()->first()->id;
        },
        'text' => $faker->text(rand(5, 10000)),
    ];
});

$factory->define(App\Media::class, function (Faker\Generator $faker) {
    return [
        'path' => $faker->image(
            storage_path('images'),
            1920, 1024,
            'people'
        ),
    ];
});

$factory->define(App\Concern::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text(rand(5, 20)),
    ];
});

$factory->define(App\BoycottConcern::class, function (Faker\Generator $faker) {
    return [
        'boycott_id' => function() {
            return App\Boycott::inRandomOrder()->first()->id;
        },
        'concern_id' => function() {
            return App\Concern::inRandomOrder()->first()->id;
        },
    ];
});
