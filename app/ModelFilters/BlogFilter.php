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

    public function scopeFilter($blog, array $filters)
    {
        foreach ($filters as $key => $value) {
            if (method_exists($this, $key)) {
                $blog->{$key}($value);
            }
        }

        return $blog;
    }

    public function title(string $title)
    {
        return $this->whereLike('title', $title);
    }

    public function content(string $content)
    {
        return $this->whereLike('content', $content);
    }

    public function description(string $description)
    {
        return $this->whereLike('description', $description);
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
