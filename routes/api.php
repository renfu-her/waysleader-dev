<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\CourseApiController;
use App\Http\Controllers\Api\CourseController;

Route::prefix('v1')->group(function () {
    // 相簿
    Route::get('albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('albums/{id}', [AlbumController::class, 'show'])->name('albums.show');

    // 最新消息
    Route::get('news', [NewsController::class, 'index'])->name('news.index');
    Route::get('news/{id}', [NewsController::class, 'show'])->name('news.show');

    // 文章分類
    Route::get('post-categories', [PostController::class, 'categories'])->name('post-categories.index');

    // 分類下的文章列表
    Route::get('post-categories/{category}/posts', [PostController::class, 'categoryPosts'])->name('post-categories.posts');

    // 單篇文章詳情
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

    // 課程列表 API
    Route::get('/courses', [CourseController::class, 'index']);

    // 單個課程詳情 API
    Route::get('/courses/{id}', [CourseController::class, 'show']);
});
