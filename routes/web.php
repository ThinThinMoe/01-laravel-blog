<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

// Route::get('/posts', [PostController::class, 'index']);
// Route::get('/posts/create', [PostController::class, 'create']);
// Route::post('/posts/store', [PostController::class, 'store']);
// Route::get('/posts/edit/{id}', [PostController::class, 'edit']);
// Route::post('/posts/update/{id}', [PostController::class, 'update']);
// Route::get('/posts/show/{id}', [PostController::class, 'show']);
// Route::get('/posts/delete/{id}', [PostController::class, 'destroy']);

Route::get('/', [PostController::class, 'index']);
Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [LoginController::class, 'create']);
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy']);
