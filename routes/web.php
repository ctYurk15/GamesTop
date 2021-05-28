<?php

use Illuminate\Support\Facades\Route;

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

//main routes
Route::get('/', function () {
    return view('main.main');
})->name('main');

Route::get('/catalog', 'App\Http\Controllers\CatalogController@index')->name('catalog');

/*Game routes*/
Route::get('/gamepage/{game}', 'App\Http\Controllers\GamePageController@show')->name('gamepage');//gamepage
Route::post('/addComment', 'App\Http\Controllers\GamePageController@addComment')->name('addComment');//add comment

/*Cart routes*/
Route::get('/cart', 'App\Http\Controllers\CartController@show')->name('cart'); //cart
Route::post('/add-to-cart', 'App\Http\Controllers\CartController@addToCart')->name('addToCart'); //add goods to cart

Route::get('/test', 'App\Http\Controllers\TestController@allGames');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
