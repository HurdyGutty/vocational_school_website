<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }
    public function class_attendance()
    {
        return $this->hasMany(Class_attendance::class);
    }
}
