<?php

namespace App\Models;

use App\ModelFilters\BatchFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    // Automatically set the 'order' field when creating a new topic
    public static function boot()
    {
        parent::boot();

        static::creating(function ($batch) {
            // Set 'order' to the next available number
            $maxOrder = Batch::max('order');
            $batch->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function modelFilter()
    {
        return $this->provideFilter(BatchFilter::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subCourse()
    {
        return $this->belongsTo(SubCourse::class);
    }
}
