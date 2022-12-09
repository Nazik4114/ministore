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
Route::group([
    'prefix'=>'product'
],function(){
    Route::post('/store',[\App\Http\Controllers\ProductController::class,'store']);
    Route::get('/index/{product}',[\App\Http\Controllers\ProductController::class,'index']);
    Route::get('/all',[\App\Http\Controllers\ProductController::class,'all']);
    Route::post('/attach/{product}/{category}',[\App\Http\Controllers\ProductController::class,'attachCategory']);
});
Route::group([
    'prefix'=>'category'
],function(){
    Route::post('/store',[\App\Http\Controllers\CategoryController::class,'store']);
    Route::get('/index/{category}',[\App\Http\Controllers\CategoryController::class,'index']);
    Route::get('/all',[\App\Http\Controllers\CategoryController::class,'all']);
    Route::post('/attach/{product}/{category}',[\App\Http\Controllers\CategoryController::class,'attachCategory']);
});



