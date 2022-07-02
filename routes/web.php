<?php

use App\Http\Controllers\App;
use App\Http\Controllers\Admin;
use App\Http\Middleware\Admin\ManagerMiddleware;
use Illuminate\Support\Facades\Route;

// Route chưa login của học sinh và giáo viên
Route::group(['as' => 'app.'], static function() {
    Route::get('/', [App\HomeController::class, 'index'])->name('index');
    Route::get('/login', [App\AuthController::class, 'loginForm'])->name('view_login');
    Route::post('/login', [App\AuthController::class, 'login'])->name('process_login');
    Route::get('/register', [App\AuthController::class, 'register'])->name('register');
});

// Route đã login của học sinh và giáo viên (chừng sau có middleware)
Route::group(['prefix' => 'app'], static function() {

});


// Route chưa login của admin
Route::group(['prefix' => 'admin', 'as' => 'admin.auth.'], static function() {
    Route::get('/login', [Admin\AuthController::class, 'loginForm'])->name('view_login');
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
