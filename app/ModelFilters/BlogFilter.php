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

    public function name(string $name)
    {
        return $this->whereLike('title', $name);
    }

    public function content($content)
    {
        return $this->where('content', $content);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }

    public function user(int $creator)
    {
        return $this->where('created_by', $creator);
    }

}
