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
    Route::get('/newest', 'ProductController@aNewest');
    Route::post('/search', 'ProductController@search');
    Route::post('/filter', 'ProductController@filter');
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
    Route::get('/{id_product}', 'CommentController@getCommentProduct');
    Route::post('', 'CommentController@add');
    Route::patch('', 'CommentController@update');
//    Route::delete('/', 'CommentController@destroy');
    Route::delete('/{id}', 'CommentController@delete');
});

Route::prefix('/votes')->group(function () {
   Route::get('', 'VoteController@index');
   Route::get('/users/{user_id}/products/{product_id}', 'VoteController@getVoteByUser');
   Route::get('/products/{product_id}', 'VoteController@getVoteByProduct');
   Route::patch('', 'VoteController@update');
   Route::post('', 'VoteController@add');
});

Route::prefix('/categories')->group(function () {
    Route::get('', 'CategoryController@index');
    Route::get('/{order_id}', 'CategoryController@show');
    Route::post('', 'CategoryController@add');
    Route::patch('', 'CategoryController@update');
    Route::delete('/{id}', 'CategoryController@destroy');
});
//middleware(['session'])->
Route::prefix('/check-out')->group(function () {
    Route::get('', 'RedirectOrderController@index');
    Route::get('/{id}', 'CheckOutController@show');
    Route::get('/order-date', 'CheckOutController@getTimeOrders');
    Route::post('/order-date', 'CheckOutController@getOrdersByTime');
    Route::post('', 'CheckOutController@add');
    Route::patch('', 'CheckOutController@update');
    Route::delete('/{id}', 'CheckOutController@destroy');
});

Route::prefix('/notifications')->group(function () {
    Route::get('', 'NotificationController@index');
    Route::post('', 'NotificationController@add');
    Route::get('/seenAll', 'NotificationController@seenAll');
    Route::delete('/{id}', 'NotificationController@destroy');
    Route::delete('/', 'NotificationController@destroyAll');
});

Route::prefix('/users')->group(function () {
    Route::prefix('/detail')->group(function () {
        Route::get('/{user_id}', 'DetailUserController@index');
        Route::post('', 'DetailUserController@add');
        Route::put('', 'DetailUserController@update');
    });
    Route::get('/history/{email}', 'CheckOutController@history');
    Route::get('/show', 'SocialAuthController@checkUser');
});

Route::post('/register','UserController@register');
Route::get('/{id}','UserController@findById');
Route::put('/user','UserController@update');

