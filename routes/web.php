<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\TeacherAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Admin Route:
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.index');
Route::post('/admin/login', [AdminAuthController::class, 'attemptLogin'])->name('admin.login');

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');

    });
});


// Teacher Route:
Route::get('/teacher/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.index');
Route::post('/teacher/login', [TeacherAuthController::class, 'attemptLogin'])->name('teacher.login');

Route::group(['prefix' => 'teacher'], function () {
    Route::group(['middleware' => 'auth.teacher'], function () {
        Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('teacher.logout');
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('teacher.dashboard');

    });
});


// Student Route:
Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.index');
Route::post('/student/login', [StudentAuthController::class, 'attemptLogin'])->name('student.login');

Route::group(['prefix' => 'student'], function () {
    Route::group(['middleware' => 'auth.student'], function () {
        Route::post('/logout', [StudentAuthController::class, 'logout'])->name('student.logout');
        Route::get('/dashboard', [StudentAuthController::class, 'dashboard'])->name('student.dashboard');

    });
});

