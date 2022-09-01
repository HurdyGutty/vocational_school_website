<?php

namespace App\Services\AccountService;

use App\Models\Admin;
use App\Models\User;
use App\Traits\Paginatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AccountService
{
    use Paginatable;
    protected string $table;
    protected Model $model;
    protected $perPage = 6;
    public function __construct(protected bool $is_admin, protected int $role)
    {
        $this->table = $is_admin ? 'admins' : 'users';
        $this->model = $is_admin ? (new Admin(['role' => $role])) : (new User(['role' => $role]));
    }

    protected function initialQuery(): Builder
    {
        return $this->model->where('role', $this->role)->select('id', 'name', 'gender', 'date_of_birth', 'phone', 'active');
    }

    public function lockAccount(User|Admin $account): void
    {
        $account->update([
            'active' => 0,
        ]);
    }

    public function unlockAccount(User|Admin $account): void
    {
        $account->update([
            'active' => 1,
        ]);
    }
}