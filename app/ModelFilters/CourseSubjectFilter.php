<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class CourseSubjectFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function user($user)
    {
        return $this->where('created_by', $user);
    }

    public function course($course)
    {
        return $this->where('course_id', $course);
    }

    public function subject($subject)
    {
        return $this->where('subject_id', $subject);
    }
}
