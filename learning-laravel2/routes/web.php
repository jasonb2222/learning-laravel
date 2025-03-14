<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', [PostController::class, 'all']);
Route::get('/blog/add', [PostController::class, 'addForm']);
Route::post('/blog/add', [PostController::class, 'create']);
Route::get('/blog/{post}', [PostController::class, 'find']);
//Route::get('/blog/{id}', [\App\Http\Controllers\PostController::class, 'find']);

Route::get( '/products', [ProductController::class, 'all']);
Route::get('/products/add', [ProductController::class, 'addForm']);
Route::post('/products/add', [ProductController::class, 'create']);
Route::get( '/products/{id}', [ProductController::class, 'find']);
