<?php

namespace App\Models;

use App\ModelFilters\TestTypeFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Automatically set the 'order' field when creating a new topic
    public static function boot()
    {
        parent::boot();

        static::creating(function ($testType) {
            // Set 'order' to the next available number
            $maxOrder = TestType::max('order');
            $testType->order = $maxOrder ? $maxOrder + 1 : 1;
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
        return $this->provideFilter(TestTypeFilter::class);
    }
}
