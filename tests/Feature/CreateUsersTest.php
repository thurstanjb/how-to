<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function _a_guest_may_not_create_a_user(){
        $this->withExceptionHandling();

        $this->put('/admin/users')
            ->assertRedirect('/login');
        $this->get('admin/users/create')
            ->assertRedirect('/login');
    }

    /** @test */
    public function _only_an_authenticated_user_can_visit_the_create_form(){
        $this->withExceptionHandling();

        $this->get('admin/users/create')
            ->assertRedirect('/login');

        $this->signIn();

        $this->get('admin/users/create')
            ->assertStatus(200);
    }

    /** @test */
    public function _only_an_authenticated_user_may_create_a_new_user(){
        $this->signIn();
        $test_user = make(User::class);
        $test_user = $test_user->toArray();
        $test_user['password'] = 'secret';
        $test_user['password_confirmation'] = 'secret';
        $response = $this->put('/admin/users', $test_user);

        $this->get($response->headers->get('location'))
            ->assertSee($test_user['name'])
            ->assertSee($test_user['email']);
    }
    
    /** @test */
    public function _it_requires_a_name(){
        $this->publishUser(['name' => null])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function _it_requires_an_email(){
        $this->publishUser(['email' => null])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function _it_requires_password(){
        $this->publishUser(['password' => null])
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function _only_an_authenticated_user_can_visit_the_update_form(){
        $this->withExceptionHandling();

        $this->get('admin/users/1/edit')
            ->assertRedirect('/login');

        $this->signIn();

        $this->get('admin/users/1/edit')
            ->assertStatus(200);
    }

    /** @test */
    public function _an_authorised_user_cannot_delete_their_own_account(){
        $user = create(User::class);
        $this->signIn($user);

        $this->delete(route('admin.users.destroy', ['user' => $user]))
            ->assertRedirect($user->path());
    }

    /** @test */
    public function _guest_users_cannot_delete_a_user(){
        $this->withExceptionHandling();
        $user = create(User::class);

        $this->delete($user->path())
            ->assertRedirect('/login');

        $this->signIn();

        $this->json('DELETE', $user->path())
            ->assertStatus(204);
    }

    /** @test */
    public function _only_authorised_users_can_update_a_user(){
        $this->withExceptionHandling();
        $user = create(User::class);

        $this->patch($user->path().'/edit', $user->toArray())
            ->assertRedirect('/login');

        $this->signIn();

        $user_data = $user->toArray();
        $user_data['password'] = '';
        $user_data['password_confirmation'] = '';

        $this->patch($user->path().'/edit', $user_data)
            ->assertRedirect(route('admin.users.index'));
    }

    public function publishUser($overrides = []){
        $this->withExceptionHandling()->signIn();
        $user = make(User::class, $overrides);
        $user->password = $user->password ?: 'secret';
        $user->password_confirmation = $user->password ?: 'secret';
        return $this->put('/admin/users', $user->toArray());
    }
}
