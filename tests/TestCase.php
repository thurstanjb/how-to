<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null, $user_type = 'auth'){
        $user = $user ?: create(User::class, ['user_type' => $user_type]);
        $this->actingAs($user);
        return $this;
    }

    public function signInAdmin(){
        return $this->signIn(null, 'admin');
    }

    public function signOut(){
        auth()->logout();
    }
}
