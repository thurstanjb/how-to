<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the related books for the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(){
        return $this->hasMany(Book::class);
    }

    public function path(){
        return '/admin/users/'.$this->id;
    }

    public function isAdmin(){
        return $this->user_type == 'admin';
    }
}
