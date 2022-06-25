<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'gender', 'date_of_birth', 'phone', 'email', 'password', 'active', 'role',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'admin_id', 'id');
    }
}

