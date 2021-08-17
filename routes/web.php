<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('todo')->group(function () {
        Route::get('/', 'TodoController@index')->middleware('auth');
        Route::get('/add', 'TodoController@add')->middleware('auth');
        Route::get('/edit', 'TodoController@edit')->middleware('auth');
        Route::get('/delete/{id}', 'TodoController@delete')->middleware('auth');
    });
});
