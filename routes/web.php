<?php

use App\Http\Controllers\App;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// Route chưa login của học sinh và giáo viên
Route::group(['name' => ''], static function() {
    Route::get('/', [App\HomeController::class, 'index']);
    Route::get('/login', [App\HomeController::class, 'login']);
    Route::get('/register', [App\HomeController::class, 'register']);
});

// Route đã login của học sinh và giáo viên (chừng sau có middleware)
Route::group(['prefix' => 'app'], static function() {

});


// Route chưa login của admin
Route::group(['prefix' => 'admin'], static function() {
    Route::get('/', [Admin\HomeController::class, 'index']);
    Route::get('/login', [Admin\HomeController::class, 'login']);
});

// Route đã login của admin (chừng sau có middleware)
Route::group(['prefix' => 'admin'], static function() {
    Route::get('/', [Admin\LandingController::class, 'index']);
});
