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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('notes', 'ApiController@getAllNotes');
Route::get('notes/{id}', 'ApiController@getNote');
Route::post('notes', 'ApiController@createNote');
Route::put('notes/{id}', 'ApiController@updateNote');
Route::delete('notes/{id}', 'ApiController@deleteNote');