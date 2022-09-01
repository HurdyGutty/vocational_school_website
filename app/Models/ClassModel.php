<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassModel extends Model
{
    use HasFactory;

    public static $x_per_parent = 2;
    public static $condition_date;

    protected $table = 'classes';
    public $timestamps = false;

    protected $fillable =  [
        'name', 'date_start', 'date_end', 'status', 'teacher_id', 'subject_id',
    ];

    public static function setConditons(int $x = 2, Carbon $date = null)
    {
        self::$x_per_parent = $x;
        self::$condition_date = $date;
        return new self;
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'class_id', 'id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'class_id', 'id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'class_id', 'id');
    }

    public function xschedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'class_id', 'id')
            ->when(
                !empty(self::$condition_date),
                fn ($q) => $q->where('date', '>', self::$condition_date)
            )
            ->orderBy('date');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'class_id', 'student_id');
    }

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'subscriptions', 'class_id', 'admin_id');
    }
}