<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klass extends Model
{
    use HasFactory;

    protected $guraded = [];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
