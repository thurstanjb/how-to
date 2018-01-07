<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserNavigationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function _only_an_admin_can_visit_the_users_section(){
        $this->get('/admin/users')
            ->assertRedirect('/login');

        $this->signIn();
        $this->get('/admin/users')
            ->assertRedirect('/');
        $this->signOut();

        $this->signInAdmin();
        $this->get('/admin/users')
            ->assertStatus(200);
    }

    /** @test */
    public function _only_an_admin_user_can_visit_the_create_form(){
        $this->withExceptionHandling();

        $this->signIn();
        $this->get('admin/users/create')
            ->assertRedirect('/');
        $this->signOut();

        $this->signInAdmin();
        $this->get('admin/users/create')
            ->assertStatus(200);
    }

    /** @test */
    public function _only_an_admin_user_can_visit_the_update_form(){
        $this->withExceptionHandling();
        $test_user = create(User::class);

        $this->get($test_user->path().'/edit')
            ->assertRedirect('/login');

        $this->signIn();
        $this->get($test_user->path().'/edit')
            ->assertRedirect('/');
        $this->signOut();

        $this->signInAdmin();
        $this->get($test_user->path().'/edit')
            ->assertStatus(200);
    }

}
