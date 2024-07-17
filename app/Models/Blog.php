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


    public function scopeFilter($blog, array $filters)
    {
        if (isset($filters['keyword']) && $filters['keyword']) {
            $blog->keyword($filters['keyword']);
        }

        // Add other filters here if needed
    }

    public function scopeKeyword($blog, string $keyword)
    {
        return $blog->where(function ($blog) use ($keyword) {
            $blog->where('title', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhere('content', 'like', "%$keyword%");
        });
    }

}
