<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class NoticeFilter extends ModelFilter
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
                ->orWhere('type', 'like', "%$keyword%");
        });
    }
    public function title($title)
    {
        return $this->where('title', $title);
    }
    public function description($description)
    {
        return $this->where('description', $description);
    }
    public function type($type)
    {
        return $this->where('type', $type);
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
