<?php

use Illuminate\Support\Facades\Route;
use App\Mail\GamesTopPurchase;

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
Route::get('/', 'App\Http\Controllers\MainController@index')->name('main');

Route::get('/email', function(){
    return new GamesTopPurchase;
});

Route::get('/catalog', 'App\Http\Controllers\CatalogController@index')->name('catalog');

/*Game routes*/
Route::get('/gamepage/{game}', 'App\Http\Controllers\GamePageController@show')->name('gamepage');//gamepage
Route::post('/addComment', 'App\Http\Controllers\GamePageController@addComment')->name('addComment');//add comment

/*Cart routes*/
Route::get('/cart', 'App\Http\Controllers\CartController@show')->name('cart'); //cart
Route::post('/change-cart', 'App\Http\Controllers\CartController@changeCart')->name('changeCart'); //add goods to cart
Route::post('/purchase-cart', 'App\Http\Controllers\CartController@purchase')->name('purchase'); //purchase goods

/*User routes*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); //homepage of user
Route::post('/changeUserData', 'App\Http\Controllers\HomeController@changeUserData')->name("changeUserData");

Route::get('/test', 'App\Http\Controllers\TestController@allGames');

Auth::routes();

