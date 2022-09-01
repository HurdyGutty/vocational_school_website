<?php

namespace App\Services\AccountService;

use App\Interface\AccountInterface;
use App\Models\Admin;
use App\Models\User;
use App\Traits\Paginatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class StaffAccount extends AccountService implements AccountInterface
{
    use Paginatable;

    public function getAccounts(): LengthAwarePaginator
    {
        $staffs = $this->initialQuery()->get();
        return $this->paginate($staffs, $this->perPage);
    }

    public function getOneAccount(int $account): Admin|User
    {
        return $this->initialQuery()->where('id', $account)->withCount([
            'subscriptions',
            'classes as success_class_count' => fn (Builder $q) => $q->select(DB::raw('count(distinct(class_id))')),
            'subscriptions as failed_subscriptions' => fn (Builder $q) => $q->withTrashed()->whereNotNull('deleted_at'),
            'classesFailed as failed_classes' => fn (Builder $q) => $q->select(DB::raw('count(distinct(class_id))')),
        ])
            ->first();
    }
}