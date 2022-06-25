<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

}
