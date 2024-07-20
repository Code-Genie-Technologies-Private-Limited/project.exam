<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function filename()
    {
        return $this->belongsTo(Blog::class);
    }
}
