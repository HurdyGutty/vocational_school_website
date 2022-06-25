<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function classes()
    {
        return $this->hasMany(ClassModel::class,"subject_id",'id');
    }
    public function major()
    {
        return $this->belongsTo(Major::class,"major_id",'id');
    }
}
