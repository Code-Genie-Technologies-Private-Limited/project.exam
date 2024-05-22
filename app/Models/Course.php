<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Automatically set the 'order' field when adding
    public static function boot()
    {
        parent::boot();

        static::creating(function ($subject) {
            // Set 'order' to the next available number
            $maxOrder = Course::max('order');
            $subject->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function sub_course()
    {
        return $this->hasMany(Subject::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
