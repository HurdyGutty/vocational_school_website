<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'description', 'time_duration', 'image_id',
    ];

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'subject_id', 'id');
    }

    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(Major::class, 'major_subjects', 'major_id', 'subject_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
}