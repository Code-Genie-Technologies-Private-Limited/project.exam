<?php

namespace App\Models;

use App\ModelFilters\CourseFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    // Automatically set the 'order' field when adding
    public static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            // Set 'order' to the next available number
            $maxOrder = Course::max('order');
            $course->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function modelFilter()
    {
        return $this->provideFilter(CourseFilter::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
