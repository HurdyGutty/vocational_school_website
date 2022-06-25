<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'classes';
    public $timestamps = false;
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class,'class_id','id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class,'class_id','id');
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class,'class_id','id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
