<?php

namespace Tests\Feature;

use App\Book;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadBooksTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function _an_author_can_filter_their_books(){
        $user = create(User::class);
        $this->signIn($user);
        $usersBook = create(Book::class, ['user_id' => $user->id, 'title' => 'My first book.']);
        $notUsersBook = create(Book::class);

        $this->get('/books?by='.$user->slug)
            ->assertSee($usersBook->title)
            ->assertDontSee($notUsersBook->title);
    }
}
