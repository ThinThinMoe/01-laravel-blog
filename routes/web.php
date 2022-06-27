<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

Route::redirect('/', '/posts');

Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [PostController::class, 'create'])->middleware('myauth');
Route::post('/posts', [PostController::class, 'store'])->middleware('myauth');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->middleware('myauth');
Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('myauth');
Route::patch('/posts/{id}', [PostController::class, 'update']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('myauth');

// Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [LoginController::class, 'create']);
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy']);


Route::get('my-posts', [MyPostController::class, 'index']);
