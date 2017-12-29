<?php

namespace Tests\Unit;

use App\Book;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use DatabaseMigrations;

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
}
