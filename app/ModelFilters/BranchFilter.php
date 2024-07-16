<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BranchFilter extends ModelFilter
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
        return $this->whereLike('branch_name', $name);
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
