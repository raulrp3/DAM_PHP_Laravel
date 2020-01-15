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

    Route::get('/{id}', 'UserController@show')->where('id', '[0-9]+')->name('users.show');

    Route::get('/new', 'UserController@create')->name('users.create');

    Route::get('/{id}/edit', 'UserController@edit')->where('id', '[0-9]+')->name('users.edit');
});