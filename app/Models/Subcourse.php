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
        return $this->belongsTo(User::class, 'course_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'created_by');
    }
}
