<?php

namespace App\Models;

use App\ModelFilters\PreviousYearPaperFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousYearPaper extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    // Automatically set the 'order' field when creating a new topic
    public static function boot()
    {
        parent::boot();

        static::creating(function ($previousYearPaper) {
            // Set 'order' to the next available number
            $maxOrder = PreviousYearPaper::max('order');
            $previousYearPaper->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function modelFilter()
    {
        return $this->provideFilter(PreviousYearPaperFilter::class);
    }
}
