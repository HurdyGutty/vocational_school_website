<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(ClassModel::class, 'subscriptions', 'admin_id', 'class_id');
    }

    public function classesFailed(): BelongsToMany
    {
        return $this->belongsToMany(ClassModel::class, 'subscriptions', 'admin_id', 'class_id')
            ->withPivot('class_id', 'admin_id', 'deleted_at')
            ->wherePivot('deleted_at', '!=', null);
    }

    protected function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
    }

    public function verify($password): bool
    {
        return password_verify($password, $this->password);
    }
}