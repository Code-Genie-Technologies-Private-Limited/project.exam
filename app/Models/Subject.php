<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
