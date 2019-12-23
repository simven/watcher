<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text(),
        'note' => $faker->numberBetween(0,10),
        'validated' => $faker->boolean(70),
    ];
});
