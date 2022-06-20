<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
