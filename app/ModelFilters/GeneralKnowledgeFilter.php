<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class GeneralKnowledgeFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function user(string $creator)
    {
        return $this->where('created_by', $creator);
    }

    public function course(int $course)
    {
        return $this->where('course_id', $course);
    }

    public function type($type)
    {
        return $this->where('type', $type);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }
}
