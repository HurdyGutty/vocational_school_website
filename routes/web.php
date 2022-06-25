<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing_page.index');
});

Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::get('/create', 'create')->name('create');
    Route::post('/create', 'store')->name('store');
});


Route::prefix('students')->name('students.')->controller(StudentController::class)->group(function () {

    Route::get('/', 'index')->name('index');

    //Sign up:
    Route::get('/create', 'create')->name('create');
    Route::post('/create', 'store')->name('store');

    // Route::delete('/destroy/{student}', 'destroy')->name('destroy');
    // Route::get('/edit/{student}', 'edit')->name('edit');
    // Route::put('/edit/{student}', 'update')->name('update');
    // Route::get('/api', 'api')->name('api');
    // Route::get('/api/search', 'apiSearch')->name('api.search');
});
