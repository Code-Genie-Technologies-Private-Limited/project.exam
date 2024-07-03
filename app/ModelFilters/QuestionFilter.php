<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class QuestionFilter extends ModelFilter
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
        return $this->whereLike($name);
    }

    public function user(int $creator)
    {
        return $this->where($creator);
    }

    public function subject(int $subject)
    {
        return $this->where($subject);
    }

    public function topic(int $topic)
    {
        return $this->where($topic);
    }

    public function status($status)
    {
        return $this->where($status);
    }
}
