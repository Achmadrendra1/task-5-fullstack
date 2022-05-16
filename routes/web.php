<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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




Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'index']);
Route::get('/article/{slug}', [HomeController::class, 'detail'])->middleware('auth')->name('home');

// Web
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/posts', [AdminController::class, 'viewPost']);
    Route::get('posts/add-post', [AdminController::class, 'addPosts']);
    Route::post('posts/addposts', [AdminController::class, 'storePosts']);
    Route::get('posts/edit/{id}', [AdminController::class, 'editPosts']);
    Route::post('posts/update/{id}', [AdminController::class, 'updatePosts']);
    Route::get('posts/destroy/{id}', [AdminController::class, 'destroyPosts']);
    Route::get('posts/add-posts/checkSlug', [AdminController::class, 'checkSlug']);
    Route::get('category', [AdminController::class, 'list_category']);
    Route::get('category/add-category', [AdminController::class, 'addCategory']);
    Route::post('category/addcategory', [AdminController::class, 'storeCategory']);
    Route::get('category/edit/{id}', [AdminController::class, 'editCategory']);
    Route::post('category/update/{id}', [AdminController::class, 'updateCategory']);
    Route::get('category/destroy/{id}', [AdminController::class, 'destroyCategory']);
}); 
