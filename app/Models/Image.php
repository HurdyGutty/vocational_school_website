<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'source'
    ];

    public function majors(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'image_id', 'id');
    }

    public function subjects(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'image_id', 'id');
    }
}
