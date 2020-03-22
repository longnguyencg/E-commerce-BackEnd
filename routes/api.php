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

Route::post('/login','ApiLoginController@login');
Route::post('/login-social', 'SocialAuthController@authorizeSocial');
Route::prefix('/products')->group(function () {
    Route::get('/', 'ProductController@index');
    Route::get('/{id}', 'ProductController@show');
    Route::post('/', 'ProductController@store');
    Route::put('/{id}', 'ProductController@update');
    Route::patch('/{id}', 'ProductController@hidden');
    Route::delete('/{id}', 'ProductController@destroy');
    Route::get('/category/{category_id}', 'ProductController@getByCategory');
});

Route::middleware(['sessions'])->prefix('/cart')->group(function () {
    Route::get('', 'CartController@index');
    Route::post('/{id}','CartController@add');
    Route::patch('','CartController@update');
    Route::delete('/{id}','CartController@delete');
    Route::post('/coupon/{coupon}', 'CartController@updateCoupon');
    Route::post('/shipping/{id}', 'CartController@shipping');
    Route::delete('','CartController@destroy');
});

Route::prefix('/comments')->group(function () {
    Route::get('', 'CommentController@index');
    Route::post('', 'CommentController@add');
    Route::patch('', 'CommentController@update');
//    Route::delete('/', 'CommentController@destroy');
    Route::delete('/{id}', 'CommentController@delete');
});

Route::post('/register','UserController@register');
Route::get('/{id}','UserController@findById');

