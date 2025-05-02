<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// ✅ FIXED: remove nested `/categories` from paths
Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'index'); // /api/categories
    Route::post('/', 'store'); // /api/categories
    Route::get('/{id}', 'show'); // /api/categories/{id}
    Route::patch('/{id}', 'update');
    Route::delete('/{id}', 'destroy'); // /api/categories/{id}
});
Route:: controller(ProductController::class)->prefix('products')->group(function(){
    Route::get('/','getProducts');
    Route::post('/','createProducts');
    Route::get('/{productId}','getproduct');
    Route::patch('/{productId}','updateProduct');
    Route::delete('/{productId}','deleteProduct');
});
