<?php

namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{

    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters passed down from the model
     *
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        if ($this->request->has('by')) {
            $this->by($this->request->by);
        }

        return $this->builder;
    }
}