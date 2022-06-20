<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
