<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('blog/posts', [\App\Http\Controllers\Api\Blog\PostController::class, 'index']);
Route::get('blog/post/{post}', [\App\Http\Controllers\Api\Blog\PostController::class, 'show']);
Route::post('blog/post', [\App\Http\Controllers\Api\Blog\PostController::class, 'store']);
Route::put('blog/post/{post}',  [\App\Http\Controllers\Api\Blog\PostController::class, 'update']);
Route::delete('blog/post/{post}',  [\App\Http\Controllers\Api\Blog\PostController::class, 'destroy']);

Route::get('blog/categories', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'index']);
Route::get('blog/category/{category}', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'show']);
Route::post('blog/category', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'store']);
Route::put('blog/category/{category}',  [\App\Http\Controllers\Api\Blog\CategoryController::class, 'update']);
Route::delete('blog/category/{category}',  [\App\Http\Controllers\Api\Blog\CategoryController::class, 'destroy']);
