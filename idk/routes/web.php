<?php

use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::post('/home', [App\Http\Controllers\HomeController::class, 'post'])->name('home');

Route::get('/follow/{post}', [App\Http\Controllers\FollowingController::class, 'follow'])->name('user.follow');

Route::get('/unfollow/{post}', [App\Http\Controllers\FollowingController::class, 'unfollow'])->name('user.unfollow');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.page');

Route::post('/comment',[\App\Http\Controllers\CommentsController::class, 'comment']);
