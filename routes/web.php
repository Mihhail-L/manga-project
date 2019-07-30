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
use App\Manga;

View::composer('layouts.app', function($view) {
    $view
    ->with('categories', Category::all())
    ->with('tags', Tag::all())
    ->with('mangas', Manga::all());
});

View::composer('inc.sidebar', function($view) {
    $view->with('categories', Category::all())
    ->with('tags', Tag::all())
    ->with('mangas', Manga::all());
});

Route::get('/', 'WelcomeController@index')->name('welcome.index');

Route::get('/mangashop', 'MangaShopController@index')->name('mangashop.index');

Route::get('/mangashop/filter/manga/{id}', 'MangaShopController@mangaFilter')->name('mangashop.manga');

Route::get('/mangashop/filter/category/{id}', 'MangaShopController@categoryFilter')->name('mangashop.category');

Route::get('/mangashop/filter/tag/{id}', 'MangaShopController@categoryFilter')->name('mangashop.tag');

Route::get('/mangashop/discounts', 'MangaShopController@discountFilter')->name('mangashop.discounts');


//actually decided that i dont want to add bundles, database is set for it though.
/*
Route::get('/mangashop/bundles', 'MangaShopController@mangaBundles')->name('mangashop.bundles');

Route::get('/mangashop/bundle/{id}', 'MangaShopController@mangaBundle')->name('mangashop.bundle');
*/

Route::get('/mangashop/volume/{id}', 'MangaShopController@show')->name('mangashop.show');

Route::get('/addtocart/{id}', 'MangaShopController@addToCart')->name('mangashop.addtocart');

Route::delete('/removefromcart/{id}', 'MangaShopController@removeCart')->name('mangashop.removefromcart');

Route::put('/updatecart/{id}', 'MangaShopController@updateCart')->name('mangashop.updatecart');

Route::get('/cart', 'MangaShopController@viewCart')->name('mangashop.view.cart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Only admins should be able to Create/Read/Update/Delete individual volumes/manga/tags/categories/users etc..
Route::middleware(['auth', 'admin'])->group(function() {

    Route::resource('/manga', 'MangaController');

    Route::resource('/volume', 'VolumeController');
    
    Route::resource('/category', 'CategoryController');
    
    Route::resource('/tags', 'TagController');

});
