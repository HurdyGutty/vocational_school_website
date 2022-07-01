<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('layout-admin-site.master');
});

Route::get('/', function () {
    return view('landing_page.index');
});

Route::group(['prefix' => 'users', 'name' => 'users.'], function () {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create', [UserController::class, 'store'])->name('store');
});
Route::group(['prefix' => 'students', 'name' => 'students.'], function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    //Sign up:
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/create', [StudentController::class, 'store'])->name('store');

});




    // Route::delete('/destroy/{student}', 'destroy')->name('destroy');
    // Route::get('/edit/{student}', 'edit')->name('edit');
    // Route::put('/edit/{student}', 'update')->name('update');
    // Route::get('/api', 'api')->name('api');
    // Route::get('/api/search', 'apiSearch')->name('api.search');
