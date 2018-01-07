<?php

namespace App\Filters;


use App\User;
use Illuminate\Http\Request;

class BookFilters extends Filters
{

    /**
     * Filter the query by a given user_slug
     *
     * @param $user_slug
     * @return mixed
     */
    public function by($user_slug)
    {
        $user = User::whereSlug($user_slug)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}