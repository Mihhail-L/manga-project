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
use App\Category;
use App\Tag;

View::composer('layouts.app', function($view) {
    $view
    ->with('categories', Category::all())
    ->with('tags', Tag::all());
});

Route::get('/', 'WelcomeController@index')->name('welcome.index');

Route::get('/mangashop', 'MangaShopController@index')->name('mangashop.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Only admins should be able to Create/Read/Update/Delete individual volumes/manga/tags/categories/uers etc..
Route::middleware(['auth', 'admin'])->group(function() {

    Route::resource('/manga', 'MangaController');

    Route::resource('/volume', 'VolumeController');
    
    Route::resource('/category', 'CategoryController');
    
    Route::resource('/tags', 'TagController');

});
