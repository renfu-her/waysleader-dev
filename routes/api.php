<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;

Route::prefix('v1')->group(function () {
    // 相簿
    Route::get('albums', [AlbumController::class, 'index']);
    Route::get('albums/{id}', [AlbumController::class, 'show']);

    // 最新消息
    Route::get('news', [NewsController::class, 'index']);
    Route::get('news/{id}', [NewsController::class, 'show']);

    // 文章分類和文章
    Route::get('categories', [PostController::class, 'categories']);
    Route::get('categories/{categoryId}/posts', [PostController::class, 'categoryPosts']);
    Route::get('posts/{id}', [PostController::class, 'show']);
});
