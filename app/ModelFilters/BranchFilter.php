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

    public function branchcode(string $branchcode)
    {
        return $this->whereLike('branch_code', $branchcode);
    }

    public function user($user)
    {
        return $this->where('created_by', $user);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }
    public function date($date)
    {
        return $this->where('start_date', $date);
    }
}
