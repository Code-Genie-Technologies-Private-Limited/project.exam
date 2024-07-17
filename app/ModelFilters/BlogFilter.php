<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BlogFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function keyword(string $keyword)
    {
        return $this->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhere('content', 'like', "%$keyword%");
        });
    }

    public function user($user)
    {
        return $this->where('created_by', $user);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }
}
