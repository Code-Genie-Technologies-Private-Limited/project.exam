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

    public function title(string $title)
    {
        return $this->whereLike('title', $title);
    }

    public function type(string $type)
    {
        return $this->where('type', $type);
    }

    public function user(int $creator)
    {
        return $this->where('created_by', $creator);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }
}
