<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Reader\CommentController;
use App\Http\Controllers\Reader\LikeController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/test', [FrontController::class, 'test'])->name('test');


// Frontpage Routes
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/post/{slug}', [FrontController::class, 'details'])->name('post.details');
Route::get('/categorized-news/{id}', [FrontController::class, 'categorizedNews'])->name('front.categorized');

// Reader Login & Register
Route::group([], function(){
    Route::get('/user/login', [AuthController::class, 'loginPage'])->name('user.loginview');
    Route::get('/user/register', [AuthController::class, 'registerPage'])->name('user.registerview');
});

// User Auth Controlling Route
Route::post('/user/register/auth', [AuthController::class, 'register'])->name('user.register');
Route::post('/user/login/auth', [AuthController::class, 'login'])->name('user.login');
Route::post('/user/logout', [AuthController::class, 'logout'])->name('user.logout');


Route::group(['middleware' => 'logged_user'], function(){
    Route::get('/user/dashboard', [FrontController::class, 'dashboard'])->name('user.dashboard')->middleware('logged_user');
    
    // Like/Comment Controller
    Route::resource('/news-comments', CommentController::class)->middleware('logged_user');
    Route::resource('/news-likes', LikeController::class)->middleware('logged_user');

});






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
