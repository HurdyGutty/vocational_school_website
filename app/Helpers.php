<?php

if (!function_exists('getName')) {
    function getName() {
        return session()->get('name');
    }
}
if (!function_exists('getRole')) {
    function getRole(): string
    {
        return session()->get('role') !== null ? "Quản lý" : "Tư vấn viên";
    }
}
if (!function_exists('getId')) {
    function getId() {
        return session()->get('id');
    }
}
