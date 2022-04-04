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

Route::post('login', function (Request $request) {
   $isLogin = auth()->attempt($request->validate([
       'email' => 'required',
       'password' => 'required',
   ]));

   return auth()->user()->createToken('auth')->plainTextToken;
});

Route::apiResource('categories', \App\Http\Controllers\API\CategoryAPIController::class);
Route::apiResource('products', \App\Http\Controllers\API\ProductAPIController::class);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('categories', App\Http\Controllers\API\CategoryAPIController::class);
    Route::resource('brands', App\Http\Controllers\API\BrandAPIController::class);
    Route::resource('products', App\Http\Controllers\API\ProductAPIController::class);
    Route::resource('orders', App\Http\Controllers\API\OrderAPIController::class);
    Route::resource('addresses', App\Http\Controllers\API\AddressAPIController::class);
    Route::resource('order_products', App\Http\Controllers\API\OrderProductAPIController::class);
    Route::resource('shopping_carts', App\Http\Controllers\API\shoppingCartAPIController::class);
    Route::resource('favourites', App\Http\Controllers\API\FavouriteAPIController::class);
    Route::resource('coupons', App\Http\Controllers\API\CouponAPIController::class);
    Route::resource('features', App\Http\Controllers\API\FeaturesAPIController::class);
    Route::resource('feature_values', App\Http\Controllers\API\FeatureValuesAPIController::class);
    Route::resource('comments', App\Http\Controllers\API\CommentAPIController::class);
    Route::resource('posts', App\Http\Controllers\API\PostAPIController::class);
    Route::resource('pages', App\Http\Controllers\API\PageAPIController::class);
    Route::resource('tags', App\Http\Controllers\API\TagAPIController::class);

});