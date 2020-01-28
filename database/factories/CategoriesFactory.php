<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Categories::class, function (Faker $faker) {
    return [
        'parent_id' => 0,
        'name' => $faker->sentence(5),

    ];
});
