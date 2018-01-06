<?php

namespace Tests\Unit;

use App\Book;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function _it_can_create_a_user_from_its_model_factory(){
        $user = create(User::class);

        $this->assertNotEmpty($user);
        $this->assertEquals('auth', $user->user_type);
    }

    /** @test */
    public function _it_can_return_its_books(){
        $user = create(User::class);

        $book1 = create(Book::class, ['user_id' => $user->id]);
        $book2 = create(Book::class, ['user_id' => $user->id]);

        $this->assertCount(2, $user->books);
    }

    /** @test */
    public function _a_user_can_return_their_profile_path(){
        $user = create(User::class);

        $this->assertEquals('/admin/users/'.$user->id, $user->path());
    }

    /** @test */
    public function _a_user_can_check_if_they_are_an_admin(){
        $user = create(User::class);

        $this->assertFalse($user->isAdmin());
    }

    /** @test */
    public function _a_user_can_check_if_it_owns_a_model(){
        $user = create(User::class);
        $user2 = create(User::class);

        $book1 = create(Book::class);
        $book2 = create(Book::class, ['user_id' => $user->id]);

        $this->assertFalse($user->owns($book1));
        $this->assertFalse($user->owns($user2));
        $this->assertTrue($user->owns($book2));
    }
}
