<?php

if (!function_exists('getName')) {
    function getName() {
        return session()->get('name');
    }
}
if (!function_exists('getRole')) {
    function getRole(): string|null
    {
        $role = session()->get('role');
        if ($role === 1) {
            return "Quản lý";
        }
        if ($role === 0) {
            return "Tư vấn viên";
        }
        return null;
    }
}
if (!function_exists('getId')) {
    function getId() {
        return session()->get('id');
    }
}
