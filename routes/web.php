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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('categories', App\Http\Controllers\CategoryController::class, ["as" => 'admin']);
    Route::resource('products', App\Http\Controllers\ProductController::class, ["as" => 'admin']);
    Route::resource('brands', App\Http\Controllers\BrandController::class, ["as" => 'admin']);
    Route::resource('orders', App\Http\Controllers\OrderController::class, ["as" => 'admin']);
    Route::resource('addresses', App\Http\Controllers\AddressController::class, ["as" => 'admin']);
    Route::resource('orderProducts', App\Http\Controllers\OrderProductController::class, ["as" => 'admin']);
    Route::resource('shoppingCarts', App\Http\Controllers\shoppingCartController::class, ["as" => 'admin']);
    Route::resource('favourites', App\Http\Controllers\FavouriteController::class, ["as" => 'admin']);
    Route::resource('coupons', App\Http\Controllers\CouponController::class, ["as" => 'admin']);
    Route::resource('features', App\Http\Controllers\FeaturesController::class, ["as" => 'admin']);
    Route::resource('featureValues', App\Http\Controllers\FeatureValuesController::class, ["as" => 'admin']);
    Route::resource('comments', App\Http\Controllers\CommentController::class, ["as" => 'admin']);
    Route::resource('posts', App\Http\Controllers\PostController::class, ["as" => 'admin']);
    Route::resource('pages', App\Http\Controllers\PageController::class, ["as" => 'admin']);
    Route::resource('tags', App\Http\Controllers\TagController::class, ["as" => 'admin']);
});
