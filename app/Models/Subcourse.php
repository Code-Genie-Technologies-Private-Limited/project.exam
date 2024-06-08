<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcourse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(Users::class, 'created_by');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
