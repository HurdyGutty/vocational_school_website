<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MajorSubject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'major_id','subject_id'
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }
}
