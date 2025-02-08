<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;

Route::prefix('v1')->group(function () {
    // 相簿
    Route::get('albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('albums/{id}', [AlbumController::class, 'show'])->name('albums.show');

    // 最新消息
    Route::get('news', [NewsController::class, 'index'])->name('news.index');
    Route::get('news/{id}', [NewsController::class, 'show'])->name('news.show');

    // 文章分類和文章
    Route::get('categories', [PostController::class, 'categories'])->name('categories.index');
    Route::get('/categories/{categoryId}', [PostController::class, 'index'])->name('categories.show');
    Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
});
