<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Automatically set the 'order' field when creating a new topic
    public static function boot()
    {
        parent::boot();

        static::creating(function ($topic) {
            // Set 'order' to the next available number
            $maxOrder = Topic::where('subject_id', $topic->subject_id)->max('order');
            $topic->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions()
    {
        // return $this->hasMany(Question::class);
    }
}
