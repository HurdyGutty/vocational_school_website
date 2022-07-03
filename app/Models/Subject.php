<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'subject_id', 'id');
    }

    public function majors(): HasMany
    {
        return $this->hasMany(MajorSubject::class, 'major_id', 'id');
    }
}
