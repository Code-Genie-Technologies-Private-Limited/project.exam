<?php

namespace App\Models;

use App\ModelFilters\BlogFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $maxOrder = Blog::max('order');
            $blog->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function modelFilter()
    {
        return $this->provideFilter(BlogFilter::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
