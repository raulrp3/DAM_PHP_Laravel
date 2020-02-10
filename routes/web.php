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

Route::get('/', 'WellcomeUserController@index')->name('wellcome');

Route::prefix('/users')->group(function() {

    Route::get('/', 'UserController@index')->name('users');

    Route::get('/{user}', 'UserController@show')->where('user', '[0-9]+')->name('users.show');

    Route::get('/new', 'UserController@create')->name('users.create');

    Route::post('/new', 'UserController@store')->name('users.create');

    Route::get('/{user}/edit', 'UserController@edit')->name('users.edit');

    Route::put('/{user}/edit', 'UserController@update')->name('users.edit');

    Route::delete('/{user}', 'UserController@destroy')->name('users.destroy');
});

Route::prefix('/professions')->group(function() {

    Route::get('/', 'ProfessionController@index')->name('professions');

    Route::delete('/{profession}', 'ProfessionController@destroy')->name('professions.destroy');
});

Route::prefix('/skills')->group(function() {

    Route::get('/', 'SkillController@index')->name('skills');
});