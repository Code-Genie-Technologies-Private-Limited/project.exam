<?php

namespace App\Models;

use App\ModelFilters\CourseSubjectFilter;
use COM;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSubject extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    public function modelFilter()
    {
        return $this->provideFilter(CourseSubjectFilter::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
