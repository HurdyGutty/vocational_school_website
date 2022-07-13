<?php

use App\Http\Controllers\App;
use App\Http\Controllers\Admin;
use App\Http\Middleware\AdminMiddleware\StaffLogin;
use App\Http\Middleware\AppMiddleware\UserLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\HomeController::class, 'index'])->name('index');

// Route chưa login của học sinh và giáo viên
Route::group(['as' => 'app.auth.'], static function() {
    Route::get('/login', [App\AuthController::class, 'loginForm'])->name('view_login');
    Route::post('/login', [App\AuthController::class, 'login'])->name('process_login');
    Route::get('/register', [App\AuthController::class, 'register'])->name('register');
});

// Route đã login của học sinh và giáo viên (chừng sau có middleware)
Route::group([
    'prefix' => 'app',
    'middleware' => [UserLogin::class],
    'as' => 'app.',
], static function() {
    Route::get('/dashboard', [App\LandingController::class, 'index'])->name('index');
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
    'middleware' => [StaffLogin::class],
    'as' => 'admin.',
), static function() {
    Route::get('/', [Admin\LandingController::class, 'index'])->name('index');

    Route::group(['prefix' => 'major', 'as' => 'major.'], static function() {
        Route::get('/', [Admin\MajorController::class, 'index'])->name('index');
        Route::get('/create', [Admin\MajorController::class, 'create'])->name('create');
        Route::post('/store', [Admin\MajorController::class, 'store'])->name('store');
        Route::get('/edit/{major}', [Admin\MajorController::class, 'edit'])->name('edit');
        Route::put('/update', [Admin\MajorController::class, 'update'])->name('update');
        Route::delete('/delete/{major}', [Admin\MajorController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'subject', 'as' => 'subject.'], static function() {
        Route::get('/', [Admin\SubjectController::class, 'index'])->name('index');
        Route::get('/create', [Admin\SubjectController::class, 'create'])->name('create');
        Route::post('/store', [Admin\SubjectController::class, 'store'])->name('store');
        Route::get('/edit', [Admin\SubjectController::class, 'edit'])->name('edit');
        Route::put('/update', [Admin\SubjectController::class, 'update'])->name('update');
        Route::delete('/delete', [Admin\SubjectController::class, 'delete'])->name('delete');
    });




});