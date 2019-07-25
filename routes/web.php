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

Route::get('/', 'WelcomeController@index')->name('welcome.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/manga', 'MangaController');

Route::resource('/volume', 'VolumeController');

Route::resource('/category', 'CategoryController');

Route::resource('/tags', 'TagController');
