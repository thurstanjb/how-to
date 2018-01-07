<?php

namespace Tests\Unit;

use App\Article;
use App\Book;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function _it_can_create_its_model_factory(){
        $article = create(Article::class);
    }

    /** @test */
    public function _it_can_return_its_book(){
        $book = create(Book::class);
        $art = create(Article::class, ['book_id' => $book->id]);

        $this->assertEquals($book->author, $art->book->author);
    }

    /** @test */
    public function _it_can_return_its_owner(){
        $user = create(User::class);
        $art = create(Article::class, ['user_id' => $user->id]);

        $this->assertEquals($user->name, $art->owner->name);
    }

    /** @test */
    public function _it_can_return_its_author_attribute(){
        $user = create(User::class);
        $art = create(Article::class, ['user_id' => $user->id]);

        $this->assertEquals($user->name, $art->author);
    }

    /** @test */
    public function _it_can_return_its_path(){
        $book = create(Book::class);
        $art = create(Article::class, ['book_id' => $book->id]);

        $this->assertEquals('/'.$book->slug.'/'.$art->slug, $art->path());
    }
}
