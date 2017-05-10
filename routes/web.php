<?php

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

Route::get('/', 'TweetController@index');

Route::get('admin', function () {
    return view('admin_template');
});

Route::get('test', 'TestController@index');

Route::get('tasks', 'TaskController@index');
Route::post('task', 'TaskController@store');
Route::delete('task/{task}', 'TaskController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('tweets', 'TweetController@index');
Route::post('tweet', 'TweetController@store')->middleware('auth');
Route::delete('tweet/{tweet}', 'TweetController@destroy')->middleware('auth');
