<?php

namespace App\Models;

use App\ModelFilters\SubCourseFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCourse extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

            static::creating(function ($subCourse) {
            $maxOrder = SubCourse::where('course_id', $subCourse->course_id)->max('order');
            $subCourse->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }
    public function modelFilter()
    {
        return $this->provideFilter(SubCourseFilter::class);
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

   
}
