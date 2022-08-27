<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

trait Paginatable
{
    public function paginate($items, $perPage = 15, $page = null, $url = null, $pageName = 'page', $options = [])
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage($pageName));
        $url = $url ?: (LengthAwarePaginator::resolveCurrentPath());
        $options['pageName'] = $pageName;
        $options['path'] = $url;
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}