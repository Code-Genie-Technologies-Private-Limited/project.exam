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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($branch) {
            $maxOrder = Branch::max('order');
            $branch->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function modalFilter()
    {
        return $this->provideFilter(BranchFilter::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
