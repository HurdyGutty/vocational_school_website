<?php

namespace App\Services\AccountService;

use App\Interface\AccountInterface;
use App\Models\Admin;
use App\Models\User;
use App\Traits\Paginatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TeacherAccount extends AccountService implements AccountInterface
{
    use Paginatable;

    public function getAccounts(): LengthAwarePaginator
    {
        $teachers = $this->initialQuery()
            ->get();

        return $this->paginate($teachers, $this->perPage);
    }

    public function getOneAccount(int $account): Admin|User
    {
        return $this->initialQuery()->where('id', $account)->withCount([
            'classes as classes_created' => fn (Builder $q) => $q->where('status', 0),
            'classes as classes_on' => fn (Builder $q) => $q->whereIn('status', [1, 2]),
            'classes as classes_ended' => fn (Builder $q) => $q->where('status', 3),
            'schedulesTeacher as periods_count' => fn (Builder $q) => $q->whereHas('class', fn ($q) => $q->where('status', '=', 3)),
        ])
            ->first();
    }
}