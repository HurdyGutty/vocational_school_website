<?php

use App\Http\Controllers\App;
use App\Http\Controllers\Admin;
use App\Http\Middleware\Admin\ManagerMiddleware;
use Illuminate\Support\Facades\Route;

// Route chưa login của học sinh và giáo viên
Route::group(['as' => ''], static function() {
    Route::get('/', [App\HomeController::class, 'index']);
    Route::get('/login', [App\HomeController::class, 'login']);
    Route::get('/register', [App\HomeController::class, 'register']);
});

// Route đã login của học sinh và giáo viên (chừng sau có middleware)
Route::group(['prefix' => 'app'], static function() {

});


// Route chưa login của admin
Route::group(['prefix' => 'admin', 'as' => 'admin.auth.'], static function() {
    Route::get('/login', [Admin\HomeController::class, 'login'])->name('view_login');
    Route::post('/login', [Admin\AuthController::class, 'login'])->name('process_login');
    Route::post('/logout', [Admin\AuthController::class, 'logout'])->name('logout');
});

// Route đã login của admin (chừng sau có middleware)
Route::group(array(
    'prefix' => 'admin',
    'middleware' => [ManagerMiddleware::class],
    'as' => 'admin.'
), static function() {
    Route::get('/', [Admin\LandingController::class, 'index'])->name('index');
});
