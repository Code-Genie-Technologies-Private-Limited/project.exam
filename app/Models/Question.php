<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
