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
Route::get('/logout','ApiLoginController@logout');

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

Route::prefix('/votes')->group(function () {
   Route::get('', 'VoteController@index');
   Route::get('/{user_id}', 'VoteController@getVoteByUser');
   Route::patch('', 'VoteController@update');
   Route::post('', 'VoteController@add');
});

Route::prefix('/categories')->group(function () {
    Route::get('', 'CategoryController@index');
    Route::get('/{id}', 'CategoryController@show');
    Route::post('', 'CategoryController@add');
    Route::patch('', 'CategoryController@update');
    Route::delete('/{id}', 'CategoryController@destroy');
});

Route::middleware(['sessions'])->prefix('/checkout')->group(function () {
    Route::get('', 'CheckOutController@index');
    Route::get('/{id}', 'CheckOutController@show');
    Route::post('', 'CheckOutController@add');
    Route::patch('', 'CheckOutController@update');
    Route::delete('/{id}', 'CheckOutController@destroy');
});

Route::post('/register','UserController@register');
Route::get('/{id}','UserController@findById');

