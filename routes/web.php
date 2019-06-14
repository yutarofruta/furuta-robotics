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

Route::get('/', function () { return view('welcome'); })->middleware('guest');

Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware'=>['auth']], function () {
    
    Route::resource('users', 'UsersController');
    Route::get('dashboard', 'UsersController@dashboard')->name('users.dashboard');
    Route::get('users/{id}/completed', 'UsersController@completed')->name('users.completed');
    
    Route::get('lessons', 'LessonsController@index')->name('lessons.index');
    Route::get('lessons/{id}', 'LessonsController@show')->name('lessons.show');
    Route::get('lessons/{id}/study', 'LessonsController@study')->name('lessons.study');
    
    Route::post('lessons/{id}/complete', 'CompleteController@store')->name('lessons.complete');
    Route::put('lessons/{id}/edit', 'CompleteController@edit')->name('lessons.edit');
    Route::delete('lessons/{id}/incomplete', 'CompleteController@destroy')->name('lessons.incomplete');
});


