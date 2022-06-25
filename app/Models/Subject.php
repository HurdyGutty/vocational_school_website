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
        'name', 'major_id',
    ];

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'subject_id', 'id');
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }
}
