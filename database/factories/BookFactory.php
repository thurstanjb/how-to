<?php

use App\Book;
use App\User;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return create(User::class)->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraphs(3, true)
    ];
});
