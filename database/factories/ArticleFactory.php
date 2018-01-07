<?php

use App\Article;
use App\User;
use App\Book;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    static $title;
    return [
        'book_id' => function(){
            return create(Book::class)->id;
        },
        'user_id' => function(){
            return create(User::class)->id;
        },
        'title' => $title ?: $title = $faker->title,
        'slug' => str_slug($title),
        'body' => $faker->paragraph(5)
    ];
});
