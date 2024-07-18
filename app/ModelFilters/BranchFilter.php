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

    public function branchCode($branch_code)
    {
        return $this->where('branch_code', $branch_code);
    }

    public function name($name)
    {
        return $this->whereLike('name', $name);
    }

    public function startDate($date)
    {
        return $this->where('start_date', $date);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }

    public function order($order)
    {
        return $this->where('order', $order);
    }
}