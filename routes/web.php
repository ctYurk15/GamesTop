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
Route::get('/gamepage/{catalog}', 'App\Http\Controllers\GamePageController@show')->name('gamepage');

Route::get('/goods', function () {
    return view('main.goods');
})->name('goods');

Route::get('/test', 'App\Http\Controllers\TestController@allGames');
Route::post('/addComment', 'App\Http\Controllers\GamePageController@addComment')->name('addComment');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
