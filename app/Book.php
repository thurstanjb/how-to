<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
      'user_id', 'title', 'description', 'slug'
    ];

    protected $appends =[
      'author', 'excerpt'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function boot(){
        parent::boot();

        static::saving(function($model){
            $model->slug = str_slug($model->title);
        });
    }

    /**
     * Return the owner for the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getAuthorAttribute(){
        return $this->owner->name;
    }

    public function getExcerptAttribute(){
        return substr($this->description,0,50).'...';
    }
}
