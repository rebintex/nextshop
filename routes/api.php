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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('categories', App\Http\Controllers\API\CategoryAPIController::class);
});




Route::group(['prefix' => 'admin'], function () {
    Route::resource('brands', App\Http\Controllers\API\BrandAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('products', App\Http\Controllers\API\ProductAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('orders', App\Http\Controllers\API\OrderAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('addresses', App\Http\Controllers\API\AddressAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('order_products', App\Http\Controllers\API\OrderProductAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('shopping_carts', App\Http\Controllers\API\shoppingCartAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('favourites', App\Http\Controllers\API\FavouriteAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('coupons', App\Http\Controllers\API\CouponAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('features', App\Http\Controllers\API\FeaturesAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('feature_values', App\Http\Controllers\API\FeatureValuesAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('comments', App\Http\Controllers\API\CommentAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('posts', App\Http\Controllers\API\PostAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('pages', App\Http\Controllers\API\PageAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('tags', App\Http\Controllers\API\TagAPIController::class);
});
