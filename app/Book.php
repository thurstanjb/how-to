<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'slug'
    ];

    protected $appends = [
        'author',
        'excerpt'
    ];

    /**
     * Set the key name for the model binding
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * While booting:
     *      saving: assign slug
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = str_slug($model->title);
        });
    }

    /**
     * Return the owner for the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Set the author attribute to the owner name
     *
     * @return mixed
     */
    public function getAuthorAttribute()
    {
        return $this->owner->name;
    }

    /**
     * Set the excerpt attribute by extracting from the description
     *
     * @return string
     */
    public function getExcerptAttribute()
    {
        return substr($this->description, 0, 50) . '...';
    }

    /**
     * Apply query scope to return filtered books
     *
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function path()
    {
        return '/' . $this->slug;
    }
}
