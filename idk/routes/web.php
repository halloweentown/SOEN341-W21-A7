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

Route::post('/home', 'App\Http\Controllers\HomeController@store')->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::post('/comment', 'App\Http\Controllers\HomeController@save');

Route::post('/follow', 'App\Http\Controllers\HomeController@follow');

Route::post('/userpage', 'App\Http\Controllers\UserpageController@basicuser');

Route::post('/followup', 'App\Http\Controllers\UserpageController@follow');

Route::post('/commentup', 'App\Http\Controllers\UserpageController@save');
