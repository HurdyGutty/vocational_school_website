<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
