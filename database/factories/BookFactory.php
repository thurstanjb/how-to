<?php

use App\Book;
use App\User;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    static $sentence;
    return [
        'user_id' => function(){
            return create(User::class)->id;
        },
        'title' => $sentence ?: $sentence = $faker->sentence,
        'slug' => str_slug($sentence),
        'description' => $faker->paragraphs(3, true)
    ];
});
