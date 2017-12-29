<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function _it_can_create_a_user_from_its_model_factory(){
        $user = create(User::class);

        $this->assertNotEmpty($user);
    }
}
