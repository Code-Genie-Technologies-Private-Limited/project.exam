<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCourse extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Automatically set the 'order' field when adding
    public static function boot()
    {
        parent::boot();

        static::creating(function ($sub_course) {
            // Set 'order' to the next available number
            $maxOrder = SubCourse::where('course_id', $sub_course->course_id)->max('order');
            $sub_course->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
