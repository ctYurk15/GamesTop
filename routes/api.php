<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//for adminka
Route::resource('/developers', 'App\Http\Controllers\Adminka\AdminkaDevController');
Route::resource('/categories', 'App\Http\Controllers\Adminka\AdminkaCategoryController');
Route::resource('/gamekeys', 'App\Http\Controllers\Adminka\AdminkaGamekeyController');
Route::resource('/comments', 'App\Http\Controllers\Adminka\AdminkaCommentsController');
Route::resource('/orders', 'App\Http\Controllers\Adminka\AdminkaOrderController');
Route::resource('/achievments', 'App\Http\Controllers\Adminka\AdminkaAchievmentController');
Route::resource('/achievment-user', 'App\Http\Controllers\Adminka\AdminkaAchievmentUserController');
Route::resource('/category-game', 'App\Http\Controllers\Adminka\AdminkaCategoryGameController');
Route::resource('/gallery-image', 'App\Http\Controllers\Adminka\AdminkaGalleryImageController');
Route::resource('/games', 'App\Http\Controllers\Adminka\AdminkaGameController');

Route::resource('/images', 'App\Http\Controllers\Adminka\AdminkaImagesController')->only(['store', 'destroy']);

