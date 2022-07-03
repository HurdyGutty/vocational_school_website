<?php

use App\Enums\AdminRoles;
use App\Enums\UserRoles;
use App\Lib\JWT\JWT;
use Illuminate\Support\Facades\App;

if (!function_exists('c')) {
    function c(string $key) {
        return App::make($key);
    }
}

if (!function_exists('getName')) {
    function getName(): string|null
    {
        $token = session()->get('token');
        if (empty($token)) {
            return null;
        }
        return c(JWT::class)->match($token)->name;
    }
}
if (!function_exists('getRole')) {
    function getRole(): string|null
    {
        $token = session()->get('token');
        if (empty($token)) {
            return null;
        }
        $data = c(JWT::class)->match($token);
        return
            $data->is_admin ?
                AdminRoles::from($data->role)->showRole() :
                UserRoles::from($data->role)->showRole();
    }
}
