<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'gender', 'date_of_birth', 'phone', 'email', 'password', 'active', 'role',
    ];

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'teacher_id', 'id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'student_id', 'id');
    }
    public function schedulesTeacher(): HasManyThrough
    {
        return $this->hasManyThrough(Schedule::class, ClassModel::class, 'teacher_id', 'class_id','id','id');
    }

    public function attendanceDetail($period): HasMany
    {
        return $this->hasMany(AttendanceDetail::class, 'student_id', 'id')
            ->where('period', $period);
    }

    protected function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
    }

    public function verify($password): bool
    {
        return password_verify($password, $this->password);
    }

}