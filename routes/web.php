<?php

use App\Http\Controllers\Blog\Admin\CategoryController;
use App\Http\Controllers\Blog\Admin\PostController as AdminPostController;
use App\Http\Controllers\Blog\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;
use App\Http\Controllers\DiggingDeeperController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['prefix' => 'digging_deeper'], function () {
    Route::get('collections', [DiggingDeeperController::class, 'collections'])
        ->name('digging_deeper.collections');

    Route::get('process-video', [DiggingDeeperController::class,'processVideo'])
        ->name('digging_deeper.processVideo');

    Route::get('prepare-catalog', [DiggingDeeperController::class,'prepareCatalog'])
        ->name('digging_deeper.prepareCatalog');
});

Route::get('api/blog/posts', [\App\Http\Controllers\Api\Blog\PostController::class, 'index']);
Route::get('api/blog/post/{post}', [\App\Http\Controllers\Api\Blog\PostController::class, 'show']);

Route::get('api/blog/categories', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'index']);
Route::get('api/blog/category/{category}', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'show']);

Route::resource('rest', RestTestController::class)->names('restTest');

Route::group([ 'namespace' => 'App\Http\Controllers\Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});


$groupData = [
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog',
];
Route::group($groupData, function () {
    //BlogCategory
    $methods = ['index','edit','store','update','create',];
    Route::resource('categories', CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');
    //BlogPost
    Route::resource('posts', AdminPostController::class)
        ->except(['show'])                               //не робити маршрут для метода show
        ->names('blog.admin.posts');
});
