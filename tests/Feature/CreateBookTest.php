<?php

namespace Tests\Feature;

use App\Book;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBookTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function _only_an_authorised_user_can_add_a_new_book(){
        $user = create(User::class);
        $book = make(Book::class, ['user_id' => $user->id]);

        $this->put(route('admin.books.store'), $book->toArray())
            ->assertRedirect('/login');


        $this->signIn($user);

        $response = $this->put(route('admin.books.store'), $book->toArray());

        $this->get($response->headers->get('location'))
            ->assertSee($book->title)
            ->assertSee($book->author);
    }

    /** @test */
    public function _it_needs_to_have_a_title(){
        $this->publishBook(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function _only_the_owner_can_update_a_book(){
        $user = create(User::class);
        $book = create(Book::class, ['user_id' => $user->id]);
        $title = 'My new title';
        $book->title = $title;

        $this->patch(route('admin.books.edit', ['book' => $book]), $book->toArray())
            ->assertRedirect('/login');

        $this->signIn();
        $this->patch(route('admin.books.edit', ['book' => $book]), $book->toArray())
            ->assertRedirect('/');
        $this->signOut();

        $this->signInAdmin();
        $this->patch(route('admin.books.edit', ['book' => $book]), $book->toArray())
            ->assertRedirect('/');
        $this->signOut();

        $this->signIn($user);
        $response = $this->patch(route('admin.books.edit', ['book' => $book]), $book->toArray());
        $this->get($response->headers->get('location'))
            ->assertSee($book->author)
            ->assertSee($title);
    }

    /** @test */
    public function _only_the_owner_can_delete_a_book(){

        $user = create(User::class);
        $book = create(Book::class, ['user_id' => $user->id]);

        $this->delete(route('admin.books.destroy', ['book' => $book]))
            ->assertRedirect('/login');

        $this->signIn();
        $this->delete(route('admin.books.destroy', ['book' => $book]))
            ->assertRedirect('/');
        $this->signOut();

        $this->signInAdmin();
        $this->delete(route('admin.books.destroy', ['book' => $book]))
            ->assertRedirect('/');
        $this->signOut();

        $this->signIn($user);
        $this->json('DELETE', route('admin.books.destroy', ['book' => $book]))
            ->assertStatus(204);
    }

    public function publishBook($overrides = []){
        $this->withExceptionHandling()->signIn();
        $book = make(Book::class, $overrides);
        return $this->put('/admin/books/create', $book->toArray());
    }
}
