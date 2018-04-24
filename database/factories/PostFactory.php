<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Post::class, function (Faker $faker) {
    return [
        //
        'title'=>$faker->sentence(6),
        'content'=>$faker->paragraph(10),
        'user_id'=>$faker->randomElement(array(1,2,3))
    ];
});
