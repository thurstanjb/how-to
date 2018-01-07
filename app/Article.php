<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'title', 'body', 'slug', 'user_id', 'book_id'
    ];

    /**
     *While booting:
     *      saving: assign slug
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function($model){
            $model->slug = str_slug($model->title);
        });
    }

    public function book(){
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getAuthorAttribute(){
        return $this->owner->name;
    }

    public function path(){
        return '/articles/'.$this->slug;
    }


}
