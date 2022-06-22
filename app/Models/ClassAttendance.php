<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAttendance extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function attendances()
    {
        return $this->belongsTo(Attendance::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
