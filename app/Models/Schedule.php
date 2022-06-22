<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'schedule';
    public function class()
    {
        return $this->belongsTo(Classes::class,'class_id','id');
    }
}
