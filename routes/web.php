<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

Route::redirect('/', '/posts');

Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [PostController::class, 'create'])->middleware('myauth')->name('post.create');
Route::post('/posts', [PostController::class, 'store'])->middleware('myauth')->name('post.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->middleware('myauth')->name('post.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('myauth')->name('post.update');
Route::patch('/posts/{id}', [PostController::class, 'update']);
Route::get('/posts/{id}', [PostController::class, 'show'])->middleware('myauth')->name('post.show');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('myauth')->name('post.delete');


Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->middleware('myauth')->name('category.create');
Route::post('/categories', [CategoryController::class, 'store'])->middleware('myauth')->name('category.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->middleware('myauth')->name('category.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('myauth')->name('category.update');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->middleware('myauth')->name('category.show');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('myauth')->name('category.delete');

// Route::resource('categories', CategoryController::class);

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [LoginController::class, 'create']);
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy']);


Route::get('my-posts', [MyPostController::class, 'index']);
