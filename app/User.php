<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
        'name', 'email', 'password', 'user_type', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function boot(){
        parent::boot();

        static::saving(function($model){
            $model->slug = str_slug($model->name);
        });
    }

    /**
     * Return the related books for the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(){
        return $this->hasMany(Book::class);
    }

    public function path(){
        return '/admin/users/'.$this->slug;
    }

    public function isAdmin(){
        return $this->user_type == 'admin';
    }

    public function owns(Model $model){
            if(method_exists($model, 'owner')){
                return $model->owner->id == $this->id;
            }
            return false;
    }
}
