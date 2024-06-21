<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class SubCourseFilter extends ModelFilter
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
        return $this->where('name', $name);
    }

    public function course(int $course)
    {
        return $this->where('course_id', $course);
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
