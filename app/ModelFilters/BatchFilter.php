<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BatchFilter extends ModelFilter
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
        return $this->whereLike('name', $name);
    }
    
    public function code(string $code)
    {
        return $this->whereLike('code', $code);
    }

    public function user($creator)
    {
        return $this->where('created_by', $creator);
    }

    public function course(int $course)
    {
        return $this->where('course_id', $course);
    }

    public function subCourse(int $subCourse)
    {
        return $this->where('sub_course_id', $subCourse);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }
}
