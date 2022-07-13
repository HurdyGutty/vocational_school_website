<?php

namespace App\Models;

use App\Events\Major\MajorDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Major extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'description', 'time_duration', 'courses', 'image_id',
    ];

    public function subjects(): HasMany
    {
        return $this->hasMany(MajorSubject::class, 'major_id', 'id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
    protected $dispatchesEvents = [
        'deleting' => MajorDelete::class,
    ];
}