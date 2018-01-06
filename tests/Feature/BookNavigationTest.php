<?php

namespace Tests\Feature;

use App\Book;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookNavigationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function _a_guest_can_view_the_books_listing_page(){
        $book = create(Book::class, ['title' => 'book']);
        $this->get(route('books.index'))
            ->assertSee($book->title);
    }

    /** @test */
    public function _it_a_guest_user_can_visit_the_book(){
        $book = create(Book::class);
        $this->get('books/'.$book->slug)
            ->assertSee($book->title);
    }

    /** @test */
    public function _only_an_authorised_user_can_visit_the_create_form(){

        $this->get(route('admin.books.create'))
            ->assertRedirect('/login');

        $this->signIn();

        $this->get(route('admin.books.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function _only_a_books_author_can_visit_the_update_form(){

        $this->withExceptionHandling();
        $user = create(User::class);
        $book = create(Book::class, ['user_id' => $user->id]);

        $this->get(route('admin.books.edit', ['book' => $book]))
            ->assertRedirect('/login');

        $this->signIn();
        $this->get(route('admin.books.edit', ['book' => $book]))
            ->assertRedirect('/');
        $this->signOut();

        $this->signInAdmin();
        $this->get(route('admin.books.edit', ['book' => $book]))
            ->assertRedirect('/');
        $this->signOut();

        $this->signIn($user);
        $this->get(route('admin.books.edit', ['book' => $book]))
            ->assertStatus(200);
        $this->signOut();

    }
}
