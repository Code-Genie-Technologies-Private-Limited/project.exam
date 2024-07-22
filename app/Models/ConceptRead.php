<?php

namespace App\Models;

use App\ModelFilters\ConceptReadFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptRead extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    // Automatically set the 'order' field when creating a new topic
    public static function boot()
    {
        parent::boot();

        static::creating(function ($conceptRead) {
            // Set 'order' to the next available number
            $maxOrder = ConceptRead::max('order');
            $conceptRead->order = $maxOrder ? $maxOrder + 1 : 1;
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

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function modelFilter()
    {
        return $this->provideFilter(ConceptReadFilter::class);
    }
}
