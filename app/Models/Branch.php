<?php

namespace App\Models;

use App\ModelFilters\BranchFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    // Automatically set the 'order' field when creating a new topic
    public static function boot()
    {
        parent::boot();

        static::creating(function ($branch) {
            // Set 'order' to the next available number
            $maxOrder = Branch::max('order');
            $branch->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function modelFilter()
    {
        return $this->provideFilter(BranchFilter::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
