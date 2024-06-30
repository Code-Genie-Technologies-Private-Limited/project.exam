<?php

namespace App\Models;

use App\ModelFilters\SubjectFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory, Filterable;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($question) {
            // Set 'order' to the next available number
            $maxOrder = question::max('order');
            $question->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }
    public function modelFilter()
    {
        return $this->provideFilter(Question::class);
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }
}
