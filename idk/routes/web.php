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

//Welcome page
Route::get('/', function () {
    return view('welcome');
});

//Authentication
Auth::routes();

//Home page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Log out
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

//Post
Route::post('/home', [App\Http\Controllers\HomeController::class, 'post'])->name('home');

//Follow user
Route::get('/follow/{post}', [App\Http\Controllers\FollowingController::class, 'follow'])->name('user.follow');

//Unfollow user
Route::get('/unfollow/{post}', [App\Http\Controllers\FollowingController::class, 'unfollow'])->name('user.unfollow');

//User's profile page
Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.page');

//Comment
Route::post('/comment',[\App\Http\Controllers\CommentsController::class, 'comment']);
