<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\Category_BrandController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/blog', [BlogController::class, 'blog']);
Route::get('/blog/detail/{id}', [BlogController::class, 'blog_detail']);
Route::get('/product', [HistoryController::class, 'history']);
Route::post('/login', [HistoryController::class, 'login']);
Route::post('/cart', [HistoryController::class, 'cart']);
Route::get('/blog/detail/rate/{id}', [BlogController::class, 'get_rate']);
Route::get('/blog/detail/cmt', [BlogController::class, 'get_cmt']);
Route::get('/home/product',[ProductController::class,'home_product']);
Route::get('/home/product/detail/{id}', [ProductController::class, 'home_product_detail']);
Route::get('/category-brand',[Category_BrandController::class,'category_brand']);
Route::post('/cart',[CartController::class,'cart_product']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/update/{id}', [UserController::class, 'update_user']);
    Route::post('product/update/add', [ProductController::class, 'add_product']);
    Route::get('/user/my-product', [ProductController::class, 'my_product']);
    Route::get('/user/product/{id}', [ProductController::class, 'get_edit_product']);
    Route::post('/user/product/{id}', [ProductController::class, 'post_edit_product']);
    Route::get('/user/product/delete/{id}', [ProductController::class, 'delete_product']);
    Route::post('/blog/detail/cmt/ajax', [BlogController::class, 'cmt']);
    Route::post('/blog/detail/rate/ajax', [BlogController::class, 'rate']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
