<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ConceptReadFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function user(int $creator)
    {
        return $this->where('created_by', $creator);
    }

    public function course(int $course)
    {
        return $this->where('course_id', $course);
    }

    public function subject(int $subject)
    {
        return $this->where('subject_id', $subject);
    }

    public function name(string $name)
    {
        return $this->where('content_type_name', $name);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }
}
