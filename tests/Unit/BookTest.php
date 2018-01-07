<?php

namespace Tests\Unit;

use App\Article;
use App\Book;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function _it_can_create_its_model_factory(){
        $book = create(Book::class );
        $this->assertNotEmpty($book);
    }

    /** @test */
    public function _it_can_return_its_owner(){
        $user = create(User::class );
        $book = create(Book::class , ['user_id' => $user->id]);
        $this->assertEquals($user->name, $book->owner->name);
    }

    /** @test */
    public function _it_can_return_its_author(){
        $user = create(User::class);
        $book = create(Book::class, ['user_id' => $user->id]);

        $this->assertEquals($user->name, $book->author);
    }

    /** @test */
    public function _it_can_return_its_articles(){
        $book = create(Book::class);
        $bookArticle = create(Article::class, ['book_id' => $book->id]);
        $notBookArticle = create(Article::class);

        $this->assertTrue($book->articles->contains($bookArticle));
        $this->assertFalse($book->articles->contains($notBookArticle));
    }

    /** @test */
    public function _it_can_generate_its_own_slug(){
        $book = create(Book::class, ['title' => "Thurstan's Book"]);

        $this->assertEquals('thurstans-book', $book->slug);
    }

    /** @test */
    public function _it_can_generate_its_own_excerpt(){
        $description = $this->faker->paragraph(10);
        $excerpt = substr($description, 0, 50).'...';
        $book = create( Book::class, ['description' => $description]);

        $this->assertEquals($excerpt, $book->excerpt);
    }

    /** @test */
    public function _it_can_return_its_path(){
        $book = create(Book::class);

        $this->assertEquals('/books/'.$book->slug, $book->path());
    }
}
