<?php

namespace App\Interface;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface AccountInterface
{
    public function getAccounts(): LengthAwarePaginator;
    public function getOneAccount(int $account): Admin|User;
    public function lockAccount(User|Admin $account): void;
    public function unlockAccount(User|Admin $account): void;
}