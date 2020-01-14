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

Route::get('/', function() {
    return 'Home';
});

Route::get('/users', function() {
    return 'Usuarios';
});

Route::get('/users/{id}', function($id) {
    return "Usuario: {$id}";
})->where('id', '[0-9]+');

Route::get('/users/new', function() {
    return 'Nuevo usuario';
});

Route::get('/users/{id}/edit', function($id) {
    return "Editando al usuario: {$id}";
})->where('id', '[0-9]+');
