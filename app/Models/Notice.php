<?php

namespace App\Models;

use App\ModelFilters\NoticeFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory , Filterable;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($notice) {
            $maxOrder = Notice::max('order');
            $notice->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function modelFilter()
    {
        return $this->provideFilter(NoticeFilter::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
