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
        return $this->belongsTo(ClassModel::class);
    }
    public function class_attendance()
    {
        return $this->belongsTo(Class_attendance::class,'class_id','id');
    }
}
