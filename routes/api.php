<?php

use App\Http\Controllers\API\PostsController;
use App\Http\Controllers\API\UserController;
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

Route::get('/user', function (Request $request) {
    return $request->user();
});

// API
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('posts', [PostsController::class, 'index']);
    Route::get('posts/{id}', [PostsController::class, 'show']);
    Route::post('posts', [PostsController::class, 'store']);
    Route::put('posts/{id}', [PostsController::class, 'update']);
    Route::delete('posts/{id}', [PostsController::class, 'destroy']);
});