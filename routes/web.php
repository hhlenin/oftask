<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/post/{id}', [FrontController::class, 'details'])->name('post.details');

// Reader Login & Register
Route::get('/user/login', [AuthController::class, 'loginPage'])->name('user.loginview')->middleware('logout_user');
Route::get('/user/register', [AuthController::class, 'registerPage'])->name('user.registerview')->middleware('logout_user');

Route::post('/user/register/auth', [AuthController::class, 'register'])->name('user.register');
Route::post('/user/login/auth', [AuthController::class, 'login'])->name('user.login');
Route::post('/user/logout', [AuthController::class, 'logout'])->name('user.logout');


Route::get('/user/dashboard', [FrontController::class, 'dashboard'])->name('user.dashboard')->middleware('logged_user');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //Category
    Route::resource('/category', CategoryController::class);

    // Tag
    Route::resource('/tag', TagController::class);

    //news
    Route::resource('/news', NewsController::class);

});
