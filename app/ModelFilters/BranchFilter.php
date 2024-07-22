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

    public function branchname(string $branchname)
    {
        return $this->whereLike('branch_name', $branchname);
    }

    public function branchcode(string $name)
    {
        return $this->whereLike('branch_code', $name);
    }
    public function startdate(string $startdate)
    {
        return $this->whereLike('start_date', $startdate);
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
