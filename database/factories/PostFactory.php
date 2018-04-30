<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'body'=>$faker->text,
        'user_id'=>$faker->numberBetween(1, 10),
        'category_id'=>$faker->numberBetween(1, 100)
    ];
});
