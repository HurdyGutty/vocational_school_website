<?php

use App\Http\Controllers\App;
use App\Http\Controllers\Admin;
use App\Http\Middleware\AdminMiddleware\AdminLogin;
use App\Http\Middleware\AdminMiddleware\StaffLogin;
use App\Http\Middleware\AppMiddleware\TeacherLogin;
use App\Http\Middleware\AppMiddleware\UserLogin;
use App\Mail\WelcomeMail;
use App\Services\AccountService\StaffAccount;
use App\Services\AccountService\TeacherAccount;
use App\Services\CheckScheduleService;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\HomeController::class, 'index'])->name('index');
Route::get('/explore', [App\HomeController::class, 'explore'])->name('explore');
Route::get('/explore/{subject}/classes', [App\HomeController::class, 'showClass'])->name('showClass')->where(['subject' => '^[0-9]+$']);

// Route chưa login của học sinh và giáo viên
Route::group(['as' => 'app.auth.'], static function () {
    Route::get('/login', [App\AuthController::class, 'loginForm'])->name('view_login');
    Route::post('/login', [App\AuthController::class, 'login'])->name('process_login');
    Route::get('/logout', [App\AuthController::class, 'logOut'])->name('logout');
    Route::get('/register', [App\AuthController::class, 'register'])->name('register');
    Route::post('/register', [App\AuthController::class, 'registerUser'])->name('process_register');

    Route::get('/verify/{user_id?}', [App\AuthController::class, 'studentVerification'])->name('studentVerification');
});

// Route đã login của học sinh và giáo viên (chừng sau có middleware)
Route::group([
    'prefix' => 'app',
    'middleware' => [UserLogin::class],
    'as' => 'app.',
], static function () {
    Route::get('/dashboard', [App\LandingController::class, 'index'])->name('index');

    Route::group(['prefix' => 'user', 'as' => 'user.', 'controller' => App\UserController::class], static function () {

        Route::get('/', 'index')->name('index');
        Route::get('/showClass/{class}', 'showClass')->name('showClass');

        Route::get('/edit',  'edit')->name('edit');
        Route::put('/update', 'update')->name('update');

        Route::get('/registerClass/{class}', 'registerClass')->name('registerClass');

        Route::group(['middleware' => [TeacherLogin::class]], static function () {
            Route::get('/createClass', 'createClass')->name('createClass');
            Route::post('/storeClass', 'storeClass')->name('storeClass');
        });
    });
});


// Route chưa login của admin
Route::group(['prefix' => 'admin', 'as' => 'admin.auth.'], static function () {
    Route::get('/login', [Admin\AuthController::class, 'loginForm'])->name('view_login');
    Route::post('/login', [Admin\AuthController::class, 'login'])->name('process_login');
    Route::get('/logout', [Admin\AuthController::class, 'logout'])->name('logout');
});

// Route đã login của admin (chừng sau có middleware)
Route::group(array(
    'prefix' => 'admin',
    'middleware' => [StaffLogin::class],
    'as' => 'admin.',
), static function () {
    Route::get('/', [Admin\LandingController::class, 'index'])->name('index');

    Route::group(['prefix' => 'major', 'as' => 'major.', 'middleware' => [AdminLogin::class]], static function () {
        Route::get('/', [Admin\MajorController::class, 'index'])->name('index');
        Route::get('/show/{major}', [Admin\MajorController::class, 'show'])->name('show');
        Route::get('/create', [Admin\MajorController::class, 'create'])->name('create');
        Route::post('/store', [Admin\MajorController::class, 'store'])->name('store');
        Route::get('/edit/{major}', [Admin\MajorController::class, 'edit'])->name('edit');
        Route::put('/update', [Admin\MajorController::class, 'update'])->name('update');
        Route::delete('/delete/{major}', [Admin\MajorController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'subject', 'as' => 'subject.', 'middleware' => [AdminLogin::class]], static function () {
        Route::get('/', [Admin\SubjectController::class, 'index'])->name('index');
        Route::get('/show/{subject}', [Admin\SubjectController::class, 'show'])->name('show');
        Route::get('/create', [Admin\SubjectController::class, 'create'])->name('create');
        Route::post('/store', [Admin\SubjectController::class, 'store'])->name('store');
        Route::get('/edit/{subject}', [Admin\SubjectController::class, 'edit'])->name('edit');
        Route::put('/update', [Admin\SubjectController::class, 'update'])->name('update');
        Route::delete('/delete/{subject}', [Admin\SubjectController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'class', 'as' => 'class.', 'controller' => Admin\ClassController::class], static function () {
        Route::group(['middleware' => [AdminLogin::class]], static function () {
            Route::get('/awaiting', 'awaitingClasses')->name('awaitingClasses');
            Route::put('/accepted', 'accepted')->name('accepted');
            Route::delete('/denied/{class_id}', 'denied')->name('denied');

            Route::get('/', 'index')->name('index');
            Route::get('/show/{class}', 'show')->name('show');

            Route::put('/restoreSubscription', 'restoreSubscription')->name('restoreSubscription');
        });
        Route::post('/check/{class_id}/{user_id}/{is_teacher}', 'checkSchedule')->name('checkSchedule');
        Route::get('/history', 'subscriptionsHistory')->name('subscriptionsHistory');
        Route::get('/pending', 'pendingSubscription')->name('pendingSubscription');
        Route::put('/approveSubscription', 'approveSubscription')->name('approveSubscription');
        Route::delete('/deleteSubscription/{class_id}&{student_id}', 'deleteSubscription')->name('deleteSubscription');
    });

    Route::group(['prefix' => 'staff', 'as' => 'staff.', 'middleware' => [AdminLogin::class], 'controller' => Admin\StaffController::class], static function () {
        Route::get('/', 'index')->name('index');
        Route::post('/show/{staff}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/lock/{staff}', 'lock')->name('lock');
        Route::put('/unlock/{staff}', 'unlock')->name('unlock');
    });

    Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => [AdminLogin::class], 'controller' => Admin\TeacherController::class], static function () {
        Route::get('/', 'index')->name('index');
        Route::post('/show/{teacher}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/lock/{teacher}', 'lock')->name('lock');
        Route::put('/unlock/{teacher}', 'unlock')->name('unlock');
    });
});

//Route test email
Route::get('/test/mail', fn () => new WelcomeMail(1, 3));
Route::get('/test/service', fn () => (new TeacherAccount(false, 1))->getOneAccount(3));